<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $directoryPath = storage_path('app/public/' . Product::URL);

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0644, true, true);
        }

        $image = fake()->image(storage_path('app/public/' . Product::URL), '320', '240', null, false);
        return [
            'name' => fake()->title,
            'description' => fake()->text,
            'cover' => 'storage/' . Product::URL . '/' . $image,
        ];
    }
}
