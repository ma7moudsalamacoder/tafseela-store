<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Identity\Services\UserManager;
use Modules\Identity\Http\Requests\SignUpRequest;
use Modules\Identity\Http\Requests\SignInRequest;
use Modules\Identity\Http\Requests\ProfileRequest;
use Modules\Identity\Http\Requests\LocationRequest;
use Modules\Identity\Enums\OtpActions;

class AuthController extends Controller
{
    public function __construct(
        protected UserManager $userManager
    ) {}

    // --- Sign In ---
    public function showSignIn()
    {
        return view('identity::auth.signin');
    }

    public function signIn(SignInRequest $request)
    {
        if ($this->userManager->signInByEmail($request->email, $request->password)) {
            $user = \Modules\Identity\Models\User::where('email', $request->email)->first();
            Auth::login($user, $request->boolean('remember'));
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => __('identity::auth.failed'),
        ]);
    }

    // --- Sign Up Flow ---
    public function showSignUp()
    {
        return view('identity::auth.signup');
    }

    public function signUp(SignUpRequest $request)
    {
        $data = $this->userManager->signUpByEmail($request->email, $request->password);
        
        // Store in session to track registration progress
        session(['reg_user_id' => $data['user']->id]);
        session(['reg_otp_hash' => $data['hash']]);

        return redirect()->route('auth.terms');
    }

    public function showTerms()
    {
        return view('identity::auth.terms');
    }

    public function acceptTerms(Request $request)
    {
        if (!$request->has('accepted')) {
            return back()->withErrors(['accepted' => __('identity::auth.terms_required')]);
        }
        
        return redirect()->route('auth.otp');
    }

    public function showOtp()
    {
        $hash = session('reg_otp_hash') ?? session('recovery_otp_hash');
        if (!$hash) return redirect()->route('auth.signin');

        return view('identity::auth.otp', ['hash' => $hash]);
    }

    public function verifyOtp(Request $request)
    {
        $userId = session('reg_user_id') ?? session('recovery_user_id');
        $hash = session('reg_otp_hash') ?? session('recovery_otp_hash');

        if ($this->userManager->verifyOTP($userId, $hash, $request->code)) {
            if (session()->has('reg_user_id')) {
                $user = \Modules\Identity\Models\User::find($userId);
                $user->markEmailAsVerified();
                Auth::login($user);
                return redirect()->route('auth.profile');
            }
            
            return redirect()->route('auth.reset-password');
        }

        return back()->withErrors(['code' => __('identity::auth.otp_invalid')]);
    }

    public function showProfile()
    {
        return view('identity::auth.profile');
    }

    public function storeProfile(ProfileRequest $request)
    {
        $this->userManager->addProfile($request->validated());
        return redirect()->route('auth.location');
    }

    public function showLocation()
    {
        return view('identity::auth.location');
    }

    public function storeLocation(LocationRequest $request)
    {
        $user = Auth::user();
        $user->locations()->create(array_merge($request->validated(), ['is_default' => true]));
        
        // Cleanup registration session
        session()->forget(['reg_user_id', 'reg_otp_hash']);
        
        return redirect()->route('home');
    }

    // --- Recovery ---
    public function showRecoverPassword()
    {
        return view('identity::auth.recover-password');
    }

    public function recoverPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $data = $this->userManager->requestAccountRecovery($request->email);

        if ($data) {
            $user = \Modules\Identity\Models\User::where('email', $request->email)->first();
            session(['recovery_user_id' => $user->id]);
            session(['recovery_otp_hash' => $data['hash']]);
            return redirect()->route('auth.otp');
        }

        return back()->withErrors(['email' => __('identity::auth.user_not_found')]);
    }

    public function showResetPassword()
    {
        return view('identity::auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $userId = session('recovery_user_id');
        if ($this->userManager->recoverAccount($userId, $request->password)) {
            session()->forget(['recovery_user_id', 'recovery_otp_hash']);
            return redirect()->route('auth.signin')->with('success', __('identity::auth.password_reset_success'));
        }

        return back()->withErrors(['password' => __('identity::auth.error_resetting_password')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

