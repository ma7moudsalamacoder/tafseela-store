<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Modules\Identity\Models\User;

class SocialAuthController extends Controller
{
    // Redirect to provider
    public function redirect(string $provider)
    {
        if ($provider === 'facebook') {
            // Replace default scopes to avoid invalid-scope failures in apps
            // that are not approved to request `email`.
            return Socialite::driver('facebook')
                ->setScopes(['public_profile'])
                ->redirect();
        }

        return Socialite::driver($provider)->redirect();
    }

    // Handle callback from provider
    public function callback(string $provider)
    {
        try {
            $driver = Socialite::driver($provider);

            if ($provider === 'facebook') {
                $driver->fields(['id', 'name', 'email']);
            }

            $socialUser = $driver->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Authentication failed, please try again.');
        }

        $providerId = (string) $socialUser->getId();
        $email = $socialUser->getEmail();
        $name = $socialUser->getName() ?: $socialUser->getNickname() ?: ucfirst($provider) . ' User';

        // Facebook may not return email depending on app permissions/review status.
        if (empty($email)) {
            $email = "fb_{$providerId}@facebook.local";
        }

        // Prefer linked social account, otherwise link existing account by email.
        $user = User::firstOrNew([
            'provider' => $provider,
            'provider_id' => $providerId,
        ]);

        if (! $user->exists) {
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                $user = $existingUser;
            }
        }

        $user->fill([
            'name' => $name,
            'email' => $email,
            'avatar' => $socialUser->getAvatar(),
            'provider' => $provider,
            'provider_id' => $providerId,
        ]);

        if (empty($user->password)) {
            $user->password = Str::random(40);
        }

        $user->save();

        // Assign default role (if using spatie/laravel-permission)
        // if (!$user->hasRole('customer')) {
        //     $user->assignRole('customer');
        // }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
