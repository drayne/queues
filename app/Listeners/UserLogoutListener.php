<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserLogoutListener
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
    public function handle(Logout $event)
    {
        $userId = $event->user->getAuthIdentifier();
        $user = User::find($userId)->first();
        $email = $user->email;

        Log::warning("Korisnik $email se odjavio");
    }
}
