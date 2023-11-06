<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends BaseModel
{
    use HasFactory, SoftDeletes;

    const URL = 'payments';
    const FILES_DIR = 'payments/{contact}';

    protected $appends = [
        'created',
        'confirmed',
    ];

    public function confirmed(): Attribute
    {
        return Attribute::make(
            get: fn() => BooleanEnum::html($this->status),
        );
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
