<?php

namespace App\Models\Traits;

trait HasCreatedBy
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($row) {
            $row->created_by = auth()->id();
        });
    }
}
