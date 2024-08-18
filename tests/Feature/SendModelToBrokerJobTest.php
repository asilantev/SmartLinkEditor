<?php

namespace Feature;

use App\Interfaces\Broker\Producer\ProducerMessageInterface;
use App\Interfaces\Broker\ProducerInterface;
use App\Jobs\SendModelToBrokerJob;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Tests\TestCase;

class SendModelToBrokerJobTest extends TestCase
{
    public function testJobHandlesCorrectly()
    {
        $model = Mockery::mock(Model::class);

        $topic = 'test_topic';
        $this->app->when('BrokerTopic.Create')
            ->needs('$model')
            ->give($model);
        $this->app->bind('BrokerTopic.Create', function () use ($topic) {
            return $topic;
        });

        $presenter = ['id' => 1, 'name' => 'Test'];
        $this->app->when('BrokerPresenter.Create')
            ->needs('$model')
            ->give($model);
        $this->app->bind('BrokerPresenter.Create', function () use ($presenter) {
            return $presenter;
        });

        $producer = Mockery::mock(ProducerInterface::class);
        $message = Mockery::mock(ProducerMessageInterface::class);

        $message->shouldReceive('withBody')
            ->once()
            ->with($presenter)
            ->andReturnSelf();
        $message->shouldReceive('onTopic')
            ->once()
            ->with($topic)
            ->andReturnSelf();
        $producer->shouldReceive('sendMessage')
            ->once()
            ->with($message);

        $job = new SendModelToBrokerJob($model);
        $job->handle($producer, $message);

        Mockery::close();
    }

    public function testJobIsQueueable()
    {
        $model = Mockery::mock(Model::class);
        $job = new SendModelToBrokerJob($model);

        $this->assertInstanceOf(\Illuminate\Contracts\Queue\ShouldQueue::class, $job);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
