<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
/**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Carbon $carbon, Request $request)
    {
        $this->carbon  = $carbon;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        session(['user_last_login' => $user->last_login]);
        session(['user_last_ip'    => $user->ip_address]);

        $user->last_login = $this->carbon->now();
        $user->ip_address = $this->request->getClientIp();

        $user->save();
    }
}
