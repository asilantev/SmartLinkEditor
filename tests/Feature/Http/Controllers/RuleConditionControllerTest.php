<?php

namespace Feature\Http\Controllers;

use App\Http\Controllers\RedirectRuleController;
use App\Http\Controllers\RuleConditionController;
use App\Models\ConditionField;
use App\Models\ConditionType;
use App\Models\RedirectRule;
use App\Models\RuleCondition;
use App\Models\SmartLink;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RuleConditionControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new RuleConditionController();
        Event::fake();
    }

    public function test1()
    {

    }
//    public function testIndex()
//    {
//        $smartLink = SmartLink::factory()->create();
//        RuleCondition::factory()->count(3)->create(['smart_link_id' => $smartLink->id]);
//
//        $conditionField = ConditionField::factory()->create();
//
//        ConditionType::factory()->create([
//            'code' => 'time_interval',
//            'name' => 'Интервал времени'
//        ]);
//        ConditionType::factory()->create([
//            'code' => 'platform',
//            'name' => 'Платформа'
//        ]);
//
//        $response = $this->controller->index();
//
//        $this->assertEquals('rule_conditions.index', $response->name());
//    }
//
//    public function testCreate()
//    {
//        $smartLink = SmartLink::factory()->create();
//        RuleCondition::factory()->count(3)->create(['smart_link_id' => $smartLink->id]);
//        ConditionType::factory()->create([
//            'code' => 'time_interval',
//            'name' => 'Интервал времени',
//        ]);
//        ConditionType::factory()->create([
//            'code' => 'platform',
//            'name' => 'Платформа'
//        ]);
//
//        $response = $this->controller->create();
//
//        $this->assertEquals('rule_conditions.create', $response->name());
//    }
//
//    public function testStore()
//    {
//        $smartLink = SmartLink::factory()->create();
//        $rule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $conditionType = ConditionType::factory()->create();
//        $request = new Request([
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => ['key' => 'value'],
//        ]);
//
//        $response = $this->controller->store($request);
//
//        $this->assertDatabaseHas('rule_conditions', [
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => json_encode(['key' => 'value']),
//        ]);
//
//        $this->assertEquals(302, $response->getStatusCode());
//        $this->assertEquals(route('rule_conditions.index'), $response->getTargetUrl());
//    }
//
//    public function testShow()
//    {
//        $smartLink = SmartLink::factory()->create();
//        $rule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $conditionType = ConditionType::factory()->create();
//        $ruleCondition = RuleCondition::factory()->create([
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => json_encode(['key' => 'value']),
//        ]);
//
//        $response = $this->controller->show($ruleCondition);
//
//        $this->assertEquals('rule_conditions.show', $response->name());
//        $this->assertEquals($ruleCondition->id, $response->getData()['ruleCondition']->id);
//        $this->assertEquals(['key' => 'value'], $response->getData()['ruleCondition']->condition_value);
//    }
//
//    public function testEdit()
//    {
//        $smartLink = SmartLink::factory()->create();
//        $rule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $conditionType = ConditionType::factory()->create();
//        $ruleCondition = RuleCondition::factory()->create([
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => json_encode(['key' => 'value']),
//        ]);
//
//        $response = $this->controller->edit($ruleCondition);
//
//        $this->assertEquals('rule_conditions.edit', $response->name());
//        $this->assertEquals($ruleCondition->id, $response->getData()['ruleCondition']->id);
//        $this->assertEquals(['key' => 'value'], $response->getData()['ruleCondition']->condition_value);
//    }
//
//    public function testUpdate()
//    {
//        $smartLink = SmartLink::factory()->create();
//        $rule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $conditionType = ConditionType::factory()->create();
//        $ruleCondition = RuleCondition::factory()->create([
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => json_encode(['key' => 'value']),
//        ]);
//
//        $newRule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $newConditionType = ConditionType::factory()->create();
//        $request = new Request([
//            'rule_id' => $newRule->id,
//            'condition_type_id' => $newConditionType->id,
//            'condition_value' => ['new_key' => 'new_value'],
//        ]);
//
//        $response = $this->controller->update($request, $ruleCondition);
//
//        $this->assertDatabaseHas('rule_conditions', [
//            'id' => $ruleCondition->id,
//            'rule_id' => $newRule->id,
//            'condition_type_id' => $newConditionType->id,
//            'condition_value' => json_encode(['new_key' => 'new_value']),
//        ]);
//
//        $this->assertEquals(302, $response->getStatusCode());
//        $this->assertEquals(route('rule_conditions.index'), $response->getTargetUrl());
//    }
//
//    public function testDestroy()
//    {
//        $smartLink = SmartLink::factory()->create();
//        $rule = RedirectRule::factory()->create(['smart_link_id' => $smartLink->id]);
//        $conditionType = ConditionType::factory()->create();
//        $ruleCondition = RuleCondition::factory()->create([
//            'rule_id' => $rule->id,
//            'condition_type_id' => $conditionType->id,
//            'condition_value' => json_encode(['key' => 'value']),
//        ]);
//
//        $response = $this->controller->destroy($ruleCondition);
//
//        $this->assertDatabaseMissing('rule_conditions', ['id' => $ruleCondition->id]);
//        $this->assertEquals(302, $response->getStatusCode());
//        $this->assertEquals(route('rule_conditions.index'), $response->getTargetUrl());
//    }
}
