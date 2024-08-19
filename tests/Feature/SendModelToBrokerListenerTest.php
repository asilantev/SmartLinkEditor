<?php

namespace Feature;

use App\Events\SendModelToBrokerEvent;
use App\Jobs\SendModelToBrokerJob;
use App\Listeners\SendModelToBrokerListener;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class SendModelToBrokerListenerTest extends TestCase
{
    public function testHandlerDispatchesSendModelToBrokerJob()
    {
        Event::fake();

        $model = Mockery::mock(Model::class);
        $event = new SendModelToBrokerEvent($model);


        Queue::fake();
        (new SendModelToBrokerListener())->handler($event);

        Queue::assertPushed(SendModelToBrokerJob::class, function ($job) use ($model) {
            $ref = new \ReflectionClass($job);
            $jobModel = $ref->getProperty('model')->getValue($job);
            return $jobModel === $model;
        });
    }
}
