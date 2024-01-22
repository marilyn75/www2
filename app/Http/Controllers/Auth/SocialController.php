<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function login($provider)
    {
        if(!array_key_exists($provider, config('services'))){
            return redirect('login')->with('error_message','지원하지 않습니다.');
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        // 세션 시작
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        try{
        $socialUser = Socialite::driver($provider)->user();
        }catch(Exception $e){
            return redirect()->route('main');
            exit;
        }
        $phone = null;
        if(!empty($socialUser->user['response']))   $phone = $socialUser->user['response']['mobile'];

        $socialAccount = SocialAccount::where([
            'provider_name' => $provider,
            'provider_id' => $socialUser->id,
        ])->first();

        // 이미 계정이 있으면 로그인
        if(!empty($socialAccount)){
            $socialAccount->update([ 
                'token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
                'expires_in' => $socialUser->expiresIn,
                'avatar' => $socialUser->avatar,
            ]);

            Auth::login($socialAccount->user);
            
            if(!empty($_SESSION['return_url'])) return redirect($_SESSION['return_url']);
            else                                return redirect()->route('main');
        }

        $user = User::where([
            'email' => $socialUser->getEmail()
        ])->first();

        if(empty($user)){
            $user = User::where([
                'name' => $socialUser->name,
                'phone' => $phone,
            ])->first();
        }

        if(empty($user)){
            $user = User::create([
                'email' => $socialUser->email,
                'name' => $socialUser->name,
                // 'password' => '',/
                // 'file' => $socialUser->avatar,
                'email_verified_at' => now(),
                'phone' => $phone,
            ]);
        }

        SocialAccount::create([
            'user_id' => $user->id,
            'provider_name' => $provider,
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'phone' => $phone,
            'provider_id' => $socialUser->id,
            'avatar' => $socialUser->avatar,
            'token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
            'expires_in' => $socialUser->expiresIn,
        ]);

        Auth::login($user);

        
        if(!empty($_SESSION['return_url'])) return redirect($_SESSION['return_url']);
        else                                return redirect()->route('main');
    }

    // 계정 연결 끊기
    public function leave_callback($provider){
        $socialUser = Socialite::driver($provider)->user();

        $result = SocialAccount::where([
            'provider_name' => $provider,
            'provider_id' => $socialUser->id,
        ])->delete();

        return redirect()->route('main');
    }
}
