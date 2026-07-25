<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // 🔍 STEP 1: Search your database users table for this incoming email address
            $user = User::where('email', $googleUser->email)->first();
            
            // 🔒 STEP 2: REGULATION GATE
            // If the email does NOT exist in your database, reject them instantly!
            if (!$user) {
                abort(403, 'Access Denied: This email address is not registered in our system.');
            }

            // 📝 STEP 3: If they are registered, link their unique Google ID if it isn't set yet
            if (!$user->google_id) {
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            }
            
            // 🔓 STEP 4: Log them into the session securely
            Auth::login($user);
            
            // 5. Send them straight to your secure dashboard route
            return redirect('/dashboard');

        } catch (Exception $e) {
            // Ensure our 403 security abort isn't caught and hidden by the generic catch block
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $e->getStatusCode() == 403) {
                throw $e;
            }
            
            return redirect('/')->with('error', 'Authentication failed.');
        }
    }
}
