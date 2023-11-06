<?php

namespace Database\Seeders;

use App\Enums\AccountStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Lead;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(3)->afterCreating(function (User $user) {
            $user->assignRole(RoleEnum::admin->value);
        })->create();
        User::factory(3)->afterCreating(function (User $user) {
            $user->assignRole(RoleEnum::team_leader->value);
            $team = $user->team()->create();
            User::factory(6)->state([
                'current_team_id' => $team->id,
            ])->afterCreating(function (User $member) {
                $member->assignRole(RoleEnum::consultant->value);
            })->create();
        })->create();
        User::factory()->afterCreating(function (User $user) {
            $user->assignRole(RoleEnum::accountant->value);
        })->create();
    }
}
