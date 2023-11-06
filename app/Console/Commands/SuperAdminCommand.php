<?php

namespace App\Console\Commands;

use App\Enums\AccountStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (RoleEnum::cases() as $role) {
            Role::create([
                'id' => $role->value,
                'name' => $role->name
            ]);
        }

        $user = User::create([
            'f_name' => config('app.name'),
            'l_name' => 'Admin',
            'email' => config('project.super_admin.email'),
            'password' => Hash::make(config('project.super_admin.password')),
            'phone' => '533444333',
            'dob' => '20-10-1994',
            'email_verified_at' => Carbon::now(),
            'account_status' => AccountStatusEnum::ACTIVE->value,
        ]);

        $user->assignRole(RoleEnum::super->value);

        $permissions = [];
        foreach (getModels() as $model => $name) {
            $permissions [] = Permission::create([
                'name' => $model . '.*'
            ]);
        }

        if ($permissions) {
            Role::find(RoleEnum::super->value)->syncPermissions($permissions);
        }
    }
}
