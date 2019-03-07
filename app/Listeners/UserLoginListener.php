<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $userId = $event->user->getAuthIdentifier();
        $user = User::find($userId)->first();
        $email = $user->email;

        Log::warning("Korisnik $email se prijavio");

    }
}
