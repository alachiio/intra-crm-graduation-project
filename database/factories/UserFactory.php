<?php

namespace Database\Factories;

use App\Enums\AccountStatusEnum;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $directoryPath = storage_path('app/public/' . User::FILES_DIR);

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0644, true, true);
        }

        $avatar = fake()->image(storage_path('app/public/' . User::FILES_DIR), '320', '320', 'people', false);
        return [
            'f_name' => fake()->firstName(),
            'l_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => fake()->numberBetween(530000000, 539999999),
            'dob' => fake()->date('Y-m-d', '1994-1-1'),
            'account_status' => AccountStatusEnum::ACTIVE->value,
            'remember_token' => Str::random(10),
            'profile_photo_path' => 'storage/' . User::FILES_DIR . '/' . $avatar,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
