<?php

namespace Tests\Unit\Models;

use App\Models\ConditionType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ConditionTypeTest extends TestCase
{
    use DatabaseTransactions;

    public function testFillableAttributes()
    {
        $conditionType = new ConditionType();
        $fillable = ['code', 'name'];

        $this->assertEquals($fillable, $conditionType->getFillable());
    }

    public function testCreateConditionType()
    {
        $data = [
            'code' => 'browser',
            'name' => 'Browser Type',
        ];

        $conditionType = ConditionType::create($data);

        $this->assertInstanceOf(ConditionType::class, $conditionType);
        $this->assertDatabaseHas('condition_types', $data);
    }

    public function testUpdateConditionType()
    {
        $conditionType = ConditionType::factory()->create();

        $updatedData = [
            'code' => 'updated_code',
            'name' => 'Updated Name'
        ];

        $conditionType->update($updatedData);

        $this->assertDatabaseHas('condition_types', $updatedData);
    }

    public function testDeleteConditionType()
    {
        $conditionType = ConditionType::factory()->create();

        $conditionType->delete();

        $this->assertDatabaseMissing('condition_types', ['id' => $conditionType->id]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }
}
