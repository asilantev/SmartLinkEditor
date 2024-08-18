<?php

namespace Database\Factories;

use App\Models\ConditionField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConditionType>
 */
class ConditionFieldFactory extends Factory
{
    protected $model = ConditionField::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            [
                'code' => 'value',
                'name' => 'Значение',
            ],
            [
                'code' => 'start',
                'name' => 'Дата начала'
            ],
            [
                'code' => 'end',
                'name' => 'Дата окончания'
            ]
        ];

        return $this->faker->randomElement($types);
    }
}
