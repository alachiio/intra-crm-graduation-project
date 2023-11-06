<?php

namespace App\Models;

use App\Enums\AccountStatusEnum;
use App\Enums\BooleanEnum;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Campaign extends BaseModel
{
    use HasFactory, SoftDeletes;

    const URL = 'campaigns';

    protected $appends = [
        'active',
        'leads_count',
        'created'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    protected function active(): Attribute
    {
        return Attribute::make(
            get: fn() => BooleanEnum::html($this->is_active),
        );
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'campaign_id');
    }

    public function getLeadsCountAttribute()
    {
        return $this->leads->count();
    }

    public function getProducts()
    {
        return Product::whereIn('id', json_decode($this->products));
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->reference_hash = Hash::make($model->name);
        });
    }
}
