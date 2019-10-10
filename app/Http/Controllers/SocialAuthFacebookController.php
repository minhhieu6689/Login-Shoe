<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SocialFacebookAccount;
use App\User;
use Socialite;
use Auth;

class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callbackGoogle()
    {
        
        $providerUser = Socialite::driver('google')->stateless()->user();
        
        $account = SocialFacebookAccount::whereProvider('google')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        
        if ($account) {

            Auth::login($account->user);
            return redirect()->to('/home');

        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'google'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1, 10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            Auth::login($user);
            return redirect()->to('/home');
        }
    }

    public function callbackFacebook()
    {
        $providerUser = Socialite::driver('facebook')->user();
        
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        

        if ($account) {

            Auth::login($account->user);
            return redirect()->to('/home');

        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1, 10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            Auth::login($user);
            return redirect()->to('/home');
        }
    }
}
