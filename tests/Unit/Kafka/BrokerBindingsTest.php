<?php

namespace Tests\Unit\Kafka;

use App\Brokers\Kafka\Message\Message;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class BrokerBindingsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testBrokerPresenterCreateWithNonExistentPresenter()
    {
        $model = $this->createMock(Model::class);
        $this->expectException(\Exception::class);

        app('BrokerPresenter.Create', [$model]);
    }

    public function testNamespaceBrokerPresenter()
    {
        $namespace = app('Namespace.BrokerPresenter');
        $this->assertEquals("\\App\\Brokers\\Presenters\\", $namespace);
    }

    public function testBrokerTopicCreate()
    {
        $model = $this->createMock(Model::class);
        $topic = app('BrokerTopic.Create', [$model]);

        $ref = new \ReflectionClass($model);
        $this->assertEquals($ref->getShortName(), $topic);
    }
}
