<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\FormMain;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PasswordForm extends FormMain
{
    public $model = User::class;
    public $props = [
        'id' => null,
        'current_password' => null,
        'password' => null,
    ];

    protected function rules(): array
    {
        return [
            'props.current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail(__('validation.custom.current_password.incorrect'));
                }
            }],
            'props.password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ]
        ];
    }

    public function mount($params = [])
    {
        parent::mount($params); // TODO: Change the autogenerated stub
        $this->editing = auth()->user();
    }

    public function submit($formData = null, $validate = true)
    {
        $message = __('Password has been updated successfully');
        $this->validate();
        try {
            auth()->user()->update([
                'password' => Hash::make($this->props['password'])
            ]);
            auth()->login(auth()->user());
            $this->emit('toast', ['icon' => 'success', 'title' => $message]);
        } catch (\Exception $e) {
            toast('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profile.password-form');
    }
}
