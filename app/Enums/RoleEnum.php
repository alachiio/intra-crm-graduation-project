<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum RoleEnum: int
{
    case super = 1;
    case admin = 2;
    case team_leader = 3;
    case consultant = 4;
    case accountant = 5;

    public function dropdown()
    {
        return match ($this->value) {
            self::super->value => Arr::where(Arr::pluck(self::cases(), 'name', 'value'), function ($name, $value) {
                return $value > 1;
            }),
            self::admin->value => Arr::where(Arr::pluck(self::cases(), 'name', 'value'), function ($name, $value) {
                return $value > 1;
            }),
            self::team_leader->value => [self::consultant->value => self::consultant->name],
        };
    }
}
