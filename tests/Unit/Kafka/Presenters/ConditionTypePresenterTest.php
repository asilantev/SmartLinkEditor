<?php

namespace Tests\Unit\Kafka\Presenters;

use App\Brokers\Presenters\ConditionType;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class ConditionTypePresenterTest extends TestCase
{
    public function testGetData()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->method('__get')->willReturnMap([
            ['code', 'test_code'],
            ['name', 'Test Name'],
        ]);

        $presenter = new ConditionType($mockModel);

        $expected = [
            'code' => 'test_code',
            'name' => 'Test Name',
        ];

        $this->assertEquals($expected, $this->invokeMethod($presenter, 'getData'));
    }

    public function testJsonSerialize()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->exists = true;
        $mockModel->method('__get')->willReturnMap([
            ['id', 1],
            ['code', 'test_code'],
            ['name', 'Test Name'],
        ]);

        $presenter = new ConditionType($mockModel);

        $expected = [
            'id' => 1,
            'deleted' => false,
            'data' => [
                'code' => 'test_code',
                'name' => 'Test Name',
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
