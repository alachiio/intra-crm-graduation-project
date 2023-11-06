<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends BaseModel
{
    protected $casts = [
        'meta' => 'array'
    ];

    public static function dropdown()
    {
        return self::pluck('meta', 'id')->map(function ($item) {
            return $item['name']['common'];
        });
    }
}
