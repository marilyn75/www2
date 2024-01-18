<?php

namespace App\Listeners;

use App\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
    public function handle(\Illuminate\Auth\Events\Logout $event): void
    {
        $user = $event->user;
        $log = $user->name . "님(".$user->email.")이 로그아웃 했습니다.";
        $log_name = "logout";
        if($user->is_admin == 1)    $log_name .= "_admin";
        // 로그 기록 구현...
        activity($log_name)->event('logout')
            ->causedBy($user)
            ->withProperties([
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent')
            ])
            ->log($log);
    }
}
