<?php

namespace App\Listeners;

use App\Events\SendModelToBrokerEvent;
use App\Jobs\SendModelToBrokerJob;

class SendModelToBrokerListener
{
    public function handler(SendModelToBrokerEvent $event): void
    {
        dispatch(new SendModelToBrokerJob($event->model));
    }
}
