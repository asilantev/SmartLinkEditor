<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

class SendModelToBrokerEvent
{
    use SerializesModels;

    public function __construct(public Model $model)
    {
    }
}
