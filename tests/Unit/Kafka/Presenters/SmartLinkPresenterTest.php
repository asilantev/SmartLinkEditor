<?php

namespace Tests\Unit\Kafka\Presenters;

use App\Brokers\Presenters\RuleCondition;
use App\Brokers\Presenters\SmartLink;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class SmartLinkPresenterTest extends TestCase
{
    public function testGetData()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->method('__get')->willReturnMap([
            ['slug', 'test-slug'],
            ['default_url', 'https://test.ru'],
            ['expires_at', null],
        ]);

        $presenter = new SmartLink($mockModel);

        $expected = [
            'slug' => 'test-slug',
            'default_url' => 'https://test.ru',
            'expires_at' => null,
        ];

        $this->assertEquals($expected, $this->invokeMethod($presenter, 'getData'));
    }

    public function testJsonSerialize()
    {
        $mockModel = $this->createMock(Model::class);
        $mockModel->exists = true;
        $mockModel->method('__get')->willReturnMap([
            ['id', 1],
            ['slug', 'test-slug'],
            ['default_url', 'https://test.ru'],
            ['expires_at', null],
        ]);

        $presenter = new SmartLink($mockModel);

        $expected = [
            'id' => 1,
            'deleted' => false,
            'data' => [
                'slug' => 'test-slug',
                'default_url' => 'https://test.ru',
                'expires_at' => null,
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
