<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum AccountStatusEnum: int
{
    case ACTIVE = 1;
    case SUSPENDED = 2;
    case CLOSED = 3;

    public static function fromName(string $name)
    {
        $name = Str::upper($name);
        return constant("self::$name");
    }

    public static function html(int $val, bool $withIcon = false)
    {
        $class = 'text-' . self::css_class($val);
        if ($withIcon) {
            return '<div class="' . $class . '"><span class="ltr:mr-1 rtl:ml-1 fa-solid fa-' . self::icon($val) . '"></span>' . Str::lower(Str::replace('_', ' ', self::from($val)->name)) . '</div>';
        }
        return '<span class="' . $class . '">' . Str::lower(Str::replace('_', ' ', self::from($val)->name)) . '</span>';
    }

    public static function css_class(int $val)
    {
        return match ($val) {
            self::ACTIVE->value => 'success',
            self::SUSPENDED->value => 'warning',
            self::CLOSED->value => 'error',
        };
    }

    public static function icon(int $val)
    {
        return match ($val) {
            self::ACTIVE->value => 'check-circle',
            self::SUSPENDED->value => 'user-lock',
            self::CLOSED->value => 'ban',
        };
    }

    public function diffForHumans()
    {
        return strtolower(str_replace('_', ' ', $this->name));
    }

    public function getEmailBody()
    {
        return match ($this->name) {
            self::ACTIVE->name => [
                'heading' => __('Your account is active now and ready for usage'),
                'text' => __('You can log in to your account from the link here: '),
                'link' => route('login')
            ],
            self::SUSPENDED->name => [
                'heading' => __('Your account is suspended and it is out of usage now'),
                'text' => __('You account goes against our policy, if you think there is something wrong, please contact us from the link here: '),
                'link' => route('login')
            ],
            self::CLOSED->name => [
                'heading' => __('Your account is closed and you cannot use it anymore'),
                'text' => __('if you think that happened by mistake, please contact us from the link here: '),
                'link' => route('login')
            ],
        };
    }
}
