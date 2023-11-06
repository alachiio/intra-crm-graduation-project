<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\TabsComponent;

class Edit extends TabsComponent
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
        $tabs = [
            'general' => [
                'icon' => 'layer-group',
                'text' => __('General')
            ],
            'password' => [
                'icon' => 'lock',
                'text' => __('Change Password')
            ],
        ];
        $this->setTabs($tabs);
    }

    public function render()
    {
        return view('livewire.profile.edit');
    }
}
