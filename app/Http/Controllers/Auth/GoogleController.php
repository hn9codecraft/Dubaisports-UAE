<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and authenticate.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // 1. Check if user exists by google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                // 2. Check if user exists by email
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Link existing account
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar'    => $googleUser->getAvatar(),
                    ]);
                } else {
                    // 3. Create new user account
                    $rawName = $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User';
                    $nameParts = explode(' ', $rawName, 2);
                    $firstName = $nameParts[0] ?? $rawName;
                    $lastName  = $nameParts[1] ?? '';

                    $user = User::create([
                        'first_name'        => $firstName,
                        'last_name'         => $lastName,
                        'email'             => $googleUser->getEmail(),
                        'google_id'         => $googleUser->getId(),
                        'avatar'            => $googleUser->getAvatar(),
                        'password'          => Hash::make(Str::random(24)),
                        'email_verified_at' => now(),
                        'status'            => '1',
                    ]);
                }
            }

            Auth::login($user, true);

            // Sync session cart with database cart
            $sessionCart = Session::get('cart');
            if (!empty($sessionCart)) {
                $dbCart = Cart::where('user_id', $user->id)->first();
                $existingProducts = ($dbCart && !empty($dbCart->products)) ? json_decode($dbCart->products, true) : [];
                $mergedProducts = array_merge($existingProducts, $sessionCart);

                Cart::updateOrCreate(
                    ['user_id' => $user->id],
                    ['products' => json_encode($mergedProducts)]
                );
                Session::forget('cart');
            }

            return redirect()->intended('/');
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Google authentication failed: ' . $e->getMessage()]);
        }
    }
}
