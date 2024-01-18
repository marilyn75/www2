<?php

namespace App\Listeners;

use App\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\Illuminate\Auth\Events\Login $event)
    {
        // 여기서 사용자 로그인 로그를 남깁니다.
        $user = $event->user;
        $log = $user->name . "님(".$user->email.")이 로그인 했습니다.";
        $log_name = "login";
        if($user->is_admin == 1)    $log_name .= "_admin";
        // 로그 기록 구현...
        activity($log_name)->event('login')
            ->causedBy($user)
            ->withProperties([
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent')
            ])
            ->log($log);
    }
}
