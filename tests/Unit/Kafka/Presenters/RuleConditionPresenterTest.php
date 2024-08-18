<?php

namespace Tests\Unit\Kafka\Presenters;

use App\Brokers\Presenters\RuleCondition;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class RuleConditionPresenterTest extends TestCase
{
    public function testGetData()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->method('__get')->willReturnMap([
            ['rule_id', 1],
            ['condition_type_id', 1],
            ['condition_value', 'condition_value'],
        ]);

        $presenter = new RuleCondition($mockModel);

        $expected = [
            'rule_id' => 1,
            'condition_type_id' => 1,
            'condition_value' => 'condition_value',
        ];

        $this->assertEquals($expected, $this->invokeMethod($presenter, 'getData'));
    }

    public function testJsonSerialize()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->exists = true;
        $mockModel->method('__get')->willReturnMap([
            ['id', 1],
            ['rule_id', 1],
            ['condition_type_id', 1],
            ['condition_value', 'condition_value'],
        ]);

        $presenter = new RuleCondition($mockModel);

        $expected = [
            'id' => 1,
            'deleted' => false,
            'data' => [
                'rule_id' => 1,
                'condition_type_id' => 1,
                'condition_value' => 'condition_value',
            ]
        ];

        $this->assertEquals($expected, $presenter->jsonSerialize());
    }

    private function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        return $method->invokeArgs($object, $parameters);
    }
}
