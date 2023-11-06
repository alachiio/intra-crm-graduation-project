<?php

namespace Database\Factories;

use App\Enums\LeadSourceEnum;
use App\Enums\RoleEnum;
use App\Models\Campaign;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'phone' => fake()->phoneNumber,
            'email' => fake()->email,
            'message' => fake()->sentence,
            'source' => Arr::random(Arr::pluck(LeadSourceEnum::cases(), 'value'), 1)[0],
            'country_id' => Country::inRandomOrder()->first()->id,
            'assigned_to' => User::whereHas('roles', fn($q) => $q->where('id', RoleEnum::consultant->value))->inRandomOrder()->first()->id ?? null,
        ];
    }
}
