<?php

namespace Tests\Unit\Models;

use App\Models\ConditionField;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ConditionFieldTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanCreateConditionField()
    {
        $conditionField = ConditionField::factory()->create();

        $this->assertDatabaseHas('condition_fields', [
            'id' => $conditionField->id,
            'name' => $conditionField->name,
            'code' => $conditionField->code,
        ]);
    }

    public function testCanUpdateConditionField()
    {
        $conditionField = ConditionField::factory()->create();

        $conditionField->name = 'new_name';
        $conditionField->code = 'new_code';
        $conditionField->save();

        $this->assertDatabaseHas('condition_fields', [
            'id' => $conditionField->id,
            'name' => 'new_name',
            'code' => 'new_code',
        ]);
    }

    public function testCanDeleteConditionField()
    {
        $conditionField = ConditionField::factory()->create();

        $conditionField->delete();

        $this->assertDatabaseMissing('condition_fields', ['id' => $conditionField->id]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }
}
