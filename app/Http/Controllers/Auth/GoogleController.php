<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            
            // SECURITY GATE: Only allow your specific Gmail account to access the app
            if ($googleUser->email !== 'muleli.haddassah@gmail.com') {
                abort(403, 'Unauthorized access.');
            }
            
            // 1. Check if a user with this specific Google ID already exists
            $user = User::where('google_id', $googleUser->id)->first();
            
            if (!$user) {
                // 2. If not, check if a user with this email address already exists
                $user = User::where('email', $googleUser->email)->first();
                
                if ($user) {
                    // Email matches an existing account, link the Google ID to it
                    $user->update(['google_id' => $googleUser->id]);
                } else {
                    // 3. Brand new user! Create a new account in your database
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => encrypt(Str::random(24)), // Dummy password for security
                    ]);
                }
            }
            
            // 4. Log the user into the application session
            Auth::login($user);
            
            // 5. Send them to your home page or dashboard route
            return redirect('/');

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Authentication failed.');
        }
    }
}
