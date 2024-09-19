<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Str;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/user');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * verify email notice handler
     */
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    /**
     * email verification handler
     */

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('dashboard');
    }

    /**
     * resending the email verification handler
     */
    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }



    public function googleAuthRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function  googleAuthCallback()
    {
        $user = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => bcrypt(Str::random(24)),
        ]);
        
        Auth::login($user, true);

        return redirect('/dashboard');
    }
}
