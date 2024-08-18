<?php

namespace Feature\Http\Controllers;

use App\Http\Controllers\SmartLinkController;
use App\Models\SmartLink;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SmartLinkControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new SmartLinkController();
        Event::fake();
    }

    public function testIndex()
    {
        SmartLink::factory()->count(15)->create();

        $response = $this->controller->index();

        $this->assertEquals('smart_links.index', $response->name());
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $response->getData()['smartLinks']);
        $this->assertEquals(10, $response->getData()['smartLinks']->perPage());
    }

    public function testCreate()
    {
        $response = $this->controller->create();

        $this->assertEquals('smart_links.create', $response->name());
    }

    public function testStore()
    {
        $request = new Request([
            'slug' => 'test-slug',
            'default_url' => 'https://example.com',
            'expires_at' => '2023-12-31',
        ]);

        $response = $this->controller->store($request);

        $this->assertDatabaseHas('smart_links', [
            'slug' => 'test-slug',
            'default_url' => 'https://example.com',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('smart_links.index'), $response->getTargetUrl());
    }

    public function testShow()
    {
        $smartLink = SmartLink::factory()->create();

        $response = $this->controller->show($smartLink);

        $this->assertEquals('smart_links.show', $response->name());
        $this->assertEquals($smartLink->id, $response->getData()['smartLink']->id);
    }

    public function testEdit()
    {
        $smartLink = SmartLink::factory()->create();

        $response = $this->controller->edit($smartLink);

        $this->assertEquals('smart_links.edit', $response->name());
        $this->assertEquals($smartLink->id, $response->getData()['smartLink']->id);
    }

    public function testUpdate()
    {
        $smartLink = SmartLink::factory()->create();
        $request = new Request([
            'slug' => 'updated-slug',
            'default_url' => 'https://updated-example.com',
            'expires_at' => '2024-12-31',
        ]);

        $response = $this->controller->update($request, $smartLink);

        $this->assertDatabaseHas('smart_links', [
            'id' => $smartLink->id,
            'slug' => 'updated-slug',
            'default_url' => 'https://updated-example.com',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('smart_links.index'), $response->getTargetUrl());
    }

    public function testDestroy()
    {
        $smartLink = SmartLink::factory()->create();

        $response = $this->controller->destroy($smartLink);

        $this->assertDatabaseMissing('smart_links', ['id' => $smartLink->id]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('smart_links.index'), $response->getTargetUrl());
    }
}
