<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\LaravelDatatables;

class ContactController extends BaseController
{
    protected $model = Contact::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = ['id', 'name', 'phone', 'email', 'address', 'created_at'];
            $columns = [
                Column::name('name')
                    ->title(__('Name'))
                    ->add(),
                Column::name('phone')
                    ->title(__('Phone'))
                    ->add(),
                Column::name('email')
                    ->title(__('Email'))
                    ->add(),
                Column::name('address')
                    ->title(__('Address'))
                    ->add(),
                Column::name('created_at as created')
                    ->title(__('Created at'))
                    ->add()
            ];

            $query = $this->model::select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->json();
        }
        return parent::index();
    }
}
