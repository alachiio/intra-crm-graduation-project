<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum LeadStatusEnum: int
{
    case new = 1;
    case delayed = 2;
    case interested = 3;
    case junk = 4;

    public static function dropdown()
    {
        return Arr::pluck(self::cases(), 'name', 'value');
    }

    public function text_css()
    {
        return match ($this->name) {
            self::new->name => 'text-primary',
            self::delayed->name => 'text-warning',
            self::interested->name => 'text-success',
            self::junk->name => 'text-error',
        };
    }
}
