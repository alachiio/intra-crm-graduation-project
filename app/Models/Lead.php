<?php

namespace App\Models;

use App\Enums\LeadStatusEnum;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends BaseModel
{
    use HasFactory, SoftDeletes;

    const URL = 'leads';

    protected $casts = [
        'interested_products' => 'array'
    ];

    protected $appends = [
        'created',
        'lead_status'
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getLeadStatusAttribute()
    {
        $leadStatus = LeadStatusEnum::from($this->status);
        return '<span class="'.$leadStatus->text_css().'">' . ucwords($leadStatus->name) . '</span>';
    }

    public function leadStatus(): HasMany
    {
        return $this->hasMany(LeadStatus::class, 'lead_id');
    }

    protected static function booted()
    {

        static::creating(function ($model) {
            if ($model->status == null)
                $model->status = LeadStatusEnum::new->value;
        });

        static::created(function ($model) {
            $model->leadStatus()->create(['status' => LeadStatusEnum::new->value]);
        });

        static::updated(function ($model) {
            if ($model->isDirty('status'))
                $model->leadStatus()->create(['status' => $model->status]);
        });
    }
}
