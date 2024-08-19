<?php

namespace Feature\Http\Controllers;

use App\Http\Controllers\RedirectRuleController;
use App\Models\RedirectRule;
use App\Models\SmartLink;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RedirectRuleControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new RedirectRuleController();
        Event::fake();
    }

    public function testIndex()
    {
        $smartLink = SmartLink::factory()->create();
        RedirectRule::factory()->count(3)->create(['smart_link_id' => $smartLink->id]);

        $response = $this->controller->index();

        $this->assertEquals('redirect_rules.index', $response->name());
        $this->assertCount(3, $response->getData()['rules']);
    }

    public function testCreate()
    {
        SmartLink::factory()->count(2)->create();

        $response = $this->controller->create();

        $this->assertEquals('redirect_rules.create', $response->name());
    }

    public function testStore()
    {
        $smartLink = SmartLink::factory()->create();
        $request = new Request([
            'smart_link_id' => $smartLink->id,
            'target_url' => 'https://example.com',
            'priority' => 1,
            'is_active' => true,
        ]);

        $response = $this->controller->store($request);

        $this->assertDatabaseHas('redirect_rules', [
            'smart_link_id' => $smartLink->id,
            'target_url' => 'https://example.com',
            'priority' => 1,
            'is_active' => true,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('redirect_rules.index'), $response->getTargetUrl());
    }

    public function testShow()
    {
        $smartLink = SmartLink::factory()->create();
        $redirectRule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);

        $response = $this->controller->show($redirectRule);

        $this->assertEquals('redirect_rules.show', $response->name());
        $this->assertEquals($redirectRule->id, $response->getData()['redirectRule']->id);
    }

    public function testEdit()
    {
        $smartLink = SmartLink::factory()->create();
        $redirectRule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
        SmartLink::factory()->count(2)->create();

        $response = $this->controller->edit($redirectRule);

        $this->assertEquals('redirect_rules.edit', $response->name());
        $this->assertEquals($redirectRule->id, $response->getData()['redirectRule']->id);
    }

    public function testUpdate()
    {
        $smartLink = SmartLink::factory()->create();
        $redirectRule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
        $newSmartLink = SmartLink::factory()->create();
        $request = new Request([
            'smart_link_id' => $newSmartLink->id,
            'target_url' => 'https://updated-example.com',
            'priority' => 2,
            'is_active' => false,
        ]);

        $response = $this->controller->update($request, $redirectRule);

        $this->assertDatabaseHas('redirect_rules', [
            'id' => $redirectRule->id,
            'smart_link_id' => $newSmartLink->id,
            'target_url' => 'https://updated-example.com',
            'priority' => 2,
            'is_active' => false,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('redirect_rules.index'), $response->getTargetUrl());
    }

    public function testDestroy()
    {
        $smartLink = SmartLink::factory()->create();
        $redirectRule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);

        $response = $this->controller->destroy($redirectRule);

        $this->assertDatabaseMissing('redirect_rules', ['id' => $redirectRule->id]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('redirect_rules.index'), $response->getTargetUrl());
    }
}
