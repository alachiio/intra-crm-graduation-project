<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel
{
    use HasFactory, SoftDeletes;

    const URL = 'contacts';

    protected $appends = [
        'created',
    ];

    public function lead(): HasOne
    {
        return $this->hasOne(Lead::class, 'lead_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'contact_id');
    }
}
