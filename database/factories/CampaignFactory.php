<?php

namespace Database\Factories;

use App\Enums\BooleanEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'purpose' => fake()->text,
            'products' => Product::factory(3)->create()->pluck('id')->toJson(),
            'is_active' => BooleanEnum::YES->value,
        ];
    }
}
