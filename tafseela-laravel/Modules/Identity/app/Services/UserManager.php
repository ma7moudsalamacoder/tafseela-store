<?php

namespace Modules\Identity\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Identity\Enums\LockReasons;
use Modules\Identity\Enums\OtpActions;
use Modules\Identity\Events\AccountCreatedEvent;
use Modules\Identity\Events\AccountLockedEvent;
use Modules\Identity\Events\AccountRecoveredEvent;
use Modules\Identity\Events\AccountUnlockedEvent;
use Modules\Identity\Events\AccountVerifiedEvent;
use Modules\Identity\Events\RecoveryRequestedEvent;
use Modules\Identity\Events\SessionStartedEvent;
use Modules\Identity\Events\VerificationFailedEvent;
use Modules\Identity\Models\AccessLock;
use Modules\Identity\Models\AccessLog;
use Modules\Identity\Models\Otp;
use Modules\Identity\Models\Profile;
use Modules\Identity\Models\User;

class UserManager
{
    private const DEVICE_HASH_COOKIE = 'device_hash';

    /**
     * Generate a One-Time Password (OTP) for a user.
     *
     * @param  int  $userId  The user ID to generate OTP for
     * @param  OtpActions  $action  The OTP action type (default: VERIFY_EMAIL)
     * @return array{otp_code: string, hash: string} Array containing OTP code and hash
     */
    public function generateOTP(int $userId, OtpActions $action = OtpActions::VERIFY_EMAIL): array
    {
        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $hash = Str::random(40);

        $otp = Otp::create([
            'user_id' => $userId,
            'hash' => $hash,
            'otp_code' => $otpCode,
            'action' => $action,
            'expires_at' => now()->addMinutes(15),
            'attempts' => 0,
        ]);

        return [
            'otp_code' => $otpCode,
            'hash' => $hash,
        ];
    }

    /**
     * Verify an OTP code for a user.
     *
     * @param  int  $userId  The user ID
     * @param  string  $hash  The OTP hash
     * @param  string  $code  The OTP code to verify
     * @return bool True if OTP is valid, false otherwise
     */
    public function verifyOTP(int $userId, string $hash, string $code): bool
    {
        $otp = Otp::where('user_id', $userId)
            ->where('hash', $hash)
            ->where('expires_at', '>', now())
            ->first();

        if (! $otp || $otp->otp_code !== $code) {
            if ($otp) {
                $otp->increment('attempts');

                if ($otp->attempts >= 3) {
                    $otp->delete();
                    VerificationFailedEvent::dispatch($userId);

                    return false;
                }
            }

            return false;
        }

        $action = $otp->action;

        $otp->delete();

        if ($action === OtpActions::FORGET_PASSWORD) {
            AccountRecoveredEvent::dispatch($userId);
        } else {
            AccountVerifiedEvent::dispatch($userId);
        }

        return true;
    }

    /**
     * Register a new user with email and password.
     *
     * @param  string  $email  User email address
     * @param  string  $password  User password
     * @return array{user: User, otp_code: string, hash: string} Array with user, OTP code and hash
     */
    public function signUpByEmail(string $email, string $password): array
    {
        $name = explode('@', $email)[0];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'provider' => 'email',
        ]);

        $user->assignRole('customer');

        $otpData = $this->generateOTP($user->id, OtpActions::VERIFY_EMAIL);

        AccountCreatedEvent::dispatch($otpData['otp_code'], $otpData['hash'], $user->id);

        return [
            'user' => $user,
            'otp_code' => $otpData['otp_code'],
            'hash' => $otpData['hash'],
        ];
    }

    /**
     * Request account recovery for a given email.
     *
     * @param  string  $email  User email address
     * @return array{otp_code: string, hash: string}|null Array with OTP data or null if user not found
     */
    public function requestAccountRecovery(string $email): ?array
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return null;
        }

        $otpData = $this->generateOTP($user->id, OtpActions::FORGET_PASSWORD);

        RecoveryRequestedEvent::dispatch($otpData['otp_code'], $otpData['hash'], $user->id);

        return $otpData;
    }

    /**
     * Recover user account by updating password.
     *
     * @param  int  $userId  The user ID
     * @param  string  $password  The new password
     * @return bool True if successful, false if user not found
     */
    public function recoverAccount(int $userId, string $password): bool
    {
        $user = User::find($userId);

        if (! $user) {
            return false;
        }

        $user->update(['password' => Hash::make($password)]);

        AccountRecoveredEvent::dispatch($userId);

        return true;
    }

    /**
     * Add a device hash cookie for the current device.
     *
     * @return string The generated device hash
     */
    public function addDeviceHash(): string
    {
        $hash = Str::random(40);

        Cookie::queue(self::DEVICE_HASH_COOKIE, $hash, 60 * 24 * 365);

        return $hash;
    }

    /**
     * Get the device hash from cookies.
     *
     * @return string|null The device hash or null if not set
     */
    public function getDeviceHash(): ?string
    {
        return Cookie::get(self::DEVICE_HASH_COOKIE);
    }

    /**
     * Lock a user account with the given reason.
     *
     * @param  int  $userId  The user ID to lock
     * @param  LockReasons  $reason  The reason for locking
     */
    public function lockAccount(int $userId, LockReasons $reason): void
    {
        $hash = $this->getDeviceHash() ?? $this->addDeviceHash();
        $ipAddress = request()->ip();
        $device = request()->userAgent();

        AccessLock::create([
            'user_id' => $userId,
            'reason' => $reason->value,
            'hash' => $hash,
            'ip_address' => $ipAddress,
            'device' => $device,
        ]);

        AccountLockedEvent::dispatch($userId);
    }

    /**
     * Unlock a user account using device hash.
     *
     * @param  int  $userId  The user ID to unlock
     * @return bool True if unlock was successful, false otherwise
     */
    public function unlockAccount(int $userId): bool
    {
        $hash = $this->getDeviceHash();

        if (! $hash) {
            return false;
        }

        $deleted = AccessLock::where('user_id', $userId)
            ->where('hash', $hash)
            ->delete() > 0;

        if ($deleted) {
            AccountUnlockedEvent::dispatch($userId);
        }

        return $deleted;
    }

    /**
     * Change user password.
     *
     * @param  int  $userId  The user ID
     * @param  string  $password  The new password
     * @return bool True if successful, false if user not found
     */
    public function changePassword(int $userId, string $password): bool
    {
        $user = User::find($userId);

        if (! $user) {
            return false;
        }

        $user->update(['password' => Hash::make($password)]);

        return true;
    }

    /**
     * Add a new profile for the authenticated user.
     *
     * @param  array  $data  Profile data
     * @return Profile The created profile
     */
    public function addProfile(array $data): Profile
    {
        $userId = auth()->id();

        return Profile::create(array_merge($data, ['user_id' => $userId]));
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  array  $data  Profile data to update
     * @return Profile|null The updated profile or null if not found
     */
    public function updateProfile(array $data): ?Profile
    {
        $userId = auth()->id();
        $profile = Profile::where('user_id', $userId)->first();

        if (! $profile) {
            return null;
        }

        $profile->update($data);

        return $profile->fresh();
    }

    /**
     * Sign in user with email and password.
     *
     * @param  string  $email  User email
     * @param  string  $password  User password
     * @return bool True if sign in successful, false otherwise
     */
    public function signInByEmail(string $email, string $password): bool
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return false;
        }

        $deviceHash = $this->getDeviceHash();

        if ($deviceHash && AccessLock::where('user_id', $user->id)->where('hash', $deviceHash)->exists()) {
            AccountLockedEvent::dispatch($user->id);

            return false;
        }

        if (! Hash::check($password, $user->password)) {
            $accessLog = AccessLog::firstOrCreate(
                ['user_id' => $user->id],
                ['attempts' => 0]
            );

            $accessLog->increment('attempts');

            if ($accessLog->attempts >= 3) {
                $this->lockAccount($user->id, LockReasons::UNAUTHORIZED_ACCESS);

                return false;
            }

            return false;
        }

        $accessLog = AccessLog::firstOrCreate(
            ['user_id' => $user->id],
            ['attempts' => 0]
        );
        $accessLog->update(['attempts' => 0]);

        SessionStartedEvent::dispatch($user->id);

        return true;
    }
}
