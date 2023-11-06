<?php

namespace App\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

enum BooleanEnum: int
{
    case YES = 1;
    case NO = 0;

    public static function fromName(string $name)
    {
        $name = Str::upper($name);
        return constant("self::$name");
    }

    public static function html(int $val = null)
    {
        $class = match ($val) {
            self::NO->value => 'text-error',
            self::YES->value => 'text-success',
        };
        return '<span class="' . $class . '">' . self::from($val)->name . '</span>';
    }

    public static function dropdown()
    {
        return Arr::pluck(self::cases(), 'name', 'value');
    }
}
