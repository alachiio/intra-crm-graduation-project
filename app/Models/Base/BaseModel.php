<?php

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $guarded = [];

    protected $hidden = ['deleted_at'];

    public static string $breadcurmbs = 'name';

    const URL = '';
    const FILES_DIR = '';

    public function getCreatedAttribute()
    {
        return (new Carbon($this->created_at))->format('Y-m-d | H:m');
    }
}
