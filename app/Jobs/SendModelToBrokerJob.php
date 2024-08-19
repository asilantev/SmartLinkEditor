<?php

namespace App\Jobs;

use App\Interfaces\Broker\Producer\ProducerMessageInterface;
use App\Interfaces\Broker\ProducerInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;

class SendModelToBrokerJob implements ShouldQueue
{
    public function __construct(private Model $model)
    {
    }

    public function handle(ProducerInterface $producer, ProducerMessageInterface $message)
    {
        $topic = app('BrokerTopic.Create', [$this->model]);
        $presenter = app('BrokerPresenter.Create', [$this->model]);
        $message
            ->withBody($presenter)
            ->onTopic($topic);

        $producer->sendMessage($message);
    }
}
