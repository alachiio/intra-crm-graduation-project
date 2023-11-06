<?php

namespace App\Http\Livewire\Contacts;

use App\Http\Livewire\FormMain;
use App\Models\Contact;
use App\Models\Role;

class Form extends FormMain
{
    protected $model = Contact::class;

    public $props = [
        'lead_id' => null,
        'name' => null,
        'phone' => null,
        'email' => null,
        'address' => null,
    ];

    protected function rules(): array
    {
        return [
            'props.name' => ['required'],
            'props.phone' => ['required'],
            'props.email' => ['nullable'],
            'props.address' => ['nullable']
        ];
    }

    public function mount($params = [])
    {
        parent::mount($params); // TODO: Change the autogenerated stub
        $this->setTitle(__('Create', ['name' => __('Contact')]));
        if ($id = request()->route('contact')) {
            $this->setEditing($id);
            $this->setTitle(__('Edit', ['name' => __('Contact') . ' : ' . $this->editing->name]));
        }
    }

    protected function saveAndRedirect($route = '')
    {
        $route = 'contacts.index';
        return parent::saveAndRedirect($route); // TODO: Change the autogenerated stub
    }


    public function render()
    {
        return view('livewire.contacts.form');
    }
}