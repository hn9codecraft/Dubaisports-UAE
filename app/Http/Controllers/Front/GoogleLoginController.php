<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $user->id)->first();
            
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/dashboard');
       
            }else{
                
                $newUser = User::create([
                    'first_name' => explode(' ',$user->name)[0],
                    'last_name' => explode(' ',$user->name)[1],
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/dashboard');
            }
      
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->intended('/');
        }
    }
}
