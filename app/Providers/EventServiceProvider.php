<?php

namespace App\Providers;

use App\Events\SendModelToBrokerEvent;
use App\Listeners\SendModelToBrokerListener;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        SendModelToBrokerEvent::class => [
            SendModelToBrokerListener::class
        ]
    ];
}
