<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     *
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * 
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 5, 50),
            'category' => $this->faker->randomElement(['starters', 'mains', 'drinks']),
            'image_path' => null,
            'is_available' => true,
        ];
    }
}