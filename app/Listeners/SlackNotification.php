<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\SlackWebhookHandler;

class SlackNotification
{
    public function onUserLogin($events)
    {
//        Log::warning('slack login');

        $slackHandler = new SlackWebhookHandler(
            'https://hooks.slack.com/services/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',
            '@vedran.bojicic',
            'atos_bot'

        );
        Log::critical(var_dump($slackHandler->getSlackRecord()));
    }

    public function onUserLogout($events)
    {
        Log::warning('slack logout');
    }

    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\SlackNotification@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\SlackNotification@onUserLogout'
        );
    }
}
