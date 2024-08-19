<?php

namespace Tests\Unit\Kafka\Presenters;

use App\Brokers\Presenters\RedirectRule;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class RedirectRulePresenterTest extends TestCase
{
    public function testGetData()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->method('__get')->willReturnMap([
            ['smart_link_id', 1],
            ['target_url', 'https://test.com'],
            ['priority', 1],
            ['is_active', 1],
        ]);

        $presenter = new RedirectRule($mockModel);

        $expected = [
            'smart_link_id' => 1,
            'target_url' => 'https://test.com',
            'priority' => 1,
            'is_active' => 1,
        ];

        $this->assertEquals($expected, $this->invokeMethod($presenter, 'getData'));
    }

    public function testJsonSerialize()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->exists = true;
        $mockModel->method('__get')->willReturnMap([
            ['id', 1],
            ['smart_link_id', 1],
            ['target_url', 'https://test.com'],
            ['priority', 1],
            ['is_active', 1],
        ]);

        $presenter = new RedirectRule($mockModel);

        $expected = [
            'id' => 1,
            'deleted' => false,
            'data' => [
                'smart_link_id' => 1,
                'target_url' => 'https://test.com',
                'priority' => 1,
                'is_active' => 1,
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
