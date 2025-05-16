<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Table ' . $this->faker->unique()->numberBetween(1, 100),
            'capacity' => $this->faker->numberBetween(2, 8),
            'is_active' => true,
        ];
    }
}