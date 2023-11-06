<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum LeadSourceEnum: int
{
    case facebook = 1;
    case instagram = 2;
    case twitter = 3;
    case snapchat = 4;
    case youtube = 5;
    case email = 6;
    case google = 7;
    case other = 8;

    public static function dropdown()
    {
        return Arr::pluck(self::cases(), 'name', 'value');
    }
}
