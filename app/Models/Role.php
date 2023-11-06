<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Role extends \Spatie\Permission\Models\Role
{
    const URL = 'roles';

    public static string $breadcurmbs = 'name';

    protected $appends = [
        'deletable'
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => __('roles.' . $value),
        );
    }

    public function deletable(): Attribute
    {
        return Attribute::make(
            get: fn() => RoleEnum::tryFrom($this->id) == null,
        );
    }
}
