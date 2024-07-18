<?php

namespace Byg\Admin\Listeners\Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginCount
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
    public function handle(object $event): void
    {
        $userInfo = $event->user->info;
        $login_count = $userInfo->where("key" ,"login_count")->first();
        if($login_count) {
            $login_count->increment("value");
        }else{
            $event->user->info()->updateOrCreate(["key"=>"login_count"],["value" => 1]);
        }
    }
}
