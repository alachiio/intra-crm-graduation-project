<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\TabsComponent;

class Show extends TabsComponent
{
    public $row = null;

    public function mount($row)
    {
        $this->setTabs([
            'general' => [
                'icon' => 'layer-group',
                'text' => __('General')
            ],
            'wallets' => [
                'icon' => 'file',
                'text' => __('Wallets')
            ],
            'documents' => [
                'icon' => 'file',
                'text' => __('Documents')
            ],
            'security_questions' => [
                'icon' => 'question-circle',
                'text' => __('Security Questions')
            ]
        ]);
        $this->row = $row;
    }

    public function render()
    {
        return view('livewire.users.show');
    }
}
