<?php

namespace App\Models;

use App\Enums\AccountStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Relations\UserRelations;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes, UserRelations;

    const URL = 'users';
    const FILES_DIR = 'users';

    public static string $breadcurmbs = 'name';

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'account_status' => 'int',
        'dob' => 'date'
    ];

    protected $appends = [
        'name',
        'status',
        'avatar',
    ];

    public function scopeNotSuperAdmin(Builder $query): Builder
    {
        return $query->whereHas('roles', function ($q) {
            return $q->whereNot('id', RoleEnum::super->value);
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('account_status', AccountStatusEnum::ACTIVE->value);
    }

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    protected function verified(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->email_verified_at != null,
        );
    }

    /**
     * Get the user's Full Name
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => ucwords($this->f_name . ' ' . $this->l_name),
        );
    }

    /**
     * Get the user's avatar
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->profile_photo_path ?: 'images/200x200.png',
        );
    }

    /**
     * Get the user's account status
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn() => AccountStatusEnum::html($this->account_status),
        );
    }

    public static function getAccountStatusDropdown()
    {
        return Arr::map(Arr::pluck(AccountStatusEnum::cases(), 'name', 'value'), function ($item) {
            return __(ucwords(Str::replace('_', ' ', Str::lower($item))));
        });
    }

    /*
     * Observers
     */

    /**
     * @return void
     * Generating a user id when the user is being created.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = fake()->unique()->randomNumber(7, 7);
        });
    }
}
