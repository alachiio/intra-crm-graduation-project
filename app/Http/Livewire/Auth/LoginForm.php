<?php

namespace App\Http\Livewire\Auth;

use App\Enums\AccountStatusEnum;
use App\Http\Livewire\FormMain;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginForm extends FormMain
{
    public $model = User::class;
    protected $request;
    public $props = [
        'email' => null,
        'password' => null,
        'remember' => false,
    ];

    protected $user;

    protected function rules(): array
    {
        return [
            'props.email' => [
                'required',
                'string',
                'email',
            ],
            'props.password' => [
                'required',
                'string'
            ]
        ];
    }

    public function submit($formData = null, $validate = true)
    {
        $this->validate();
        return $this->loginDefault();
    }

    private function loginDefault()
    {
        $this->request = new LoginRequest([
            'email' => $this->props['email'],
            'password' => $this->props['password'],
            'remember' => $this->props['remember']
        ]);

        $this->ensureIsNotRateLimited('email');

        $this->user = User::where('email', $this->props['email'])->first();

        if (!$this->isAccountActive()) {
            return;
        }

        if (!Auth::attempt($this->request->only('email', 'password'), $this->request->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey('email'));
            $this->addError('props.email', __('auth.failed'));
            return;
        }

        RateLimiter::clear($this->throttleKey('email'));

        request()->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function isAccountActive()
    {
        if ($this->user and $this->user->account_status > AccountStatusEnum::ACTIVE->value) {
            RateLimiter::hit($this->throttleKey('email'));
            $this->emit('toast', ['icon' => 'warning', 'text' => 'Your account is ' . AccountStatusEnum::from($this->user->account_status)->diffForHumans()], 'swal');
            return false;
        }
        return true;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function ensureIsNotRateLimited($input): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($input), 5)) {
            return;
        }

        event(new Lockout($this->request));

        $seconds = RateLimiter::availableIn($this->throttleKey($input));

        $this->addError('props.email', __('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]));
    }

    protected function validationAttributes(): array
    {
        return [
            'props.email' => __('Email'),
            'props.password' => __('Password'),
        ];
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    private function throttleKey($input): string
    {
        return Str::transliterate(Str::lower($this->props[$input]) . '|' . request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
