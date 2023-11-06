<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory, SoftDeletes;

    const URL = 'products';

    protected $appends = [
        'created',
        'cover_photo',
    ];

    public function getCoverPhotoAttribute()
    {
        return asset($this->cover) ?: 'images/200x200.png';
    }
}
