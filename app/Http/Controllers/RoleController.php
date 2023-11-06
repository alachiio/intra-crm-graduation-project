<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Role;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\LaravelDatatables;

class RoleController extends BaseController
{
    protected $model = Role::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = ['roles.id', 'roles.name'];
            $columns = [
                Column::name('name')
                    ->orderable(false)
                    ->title(__('Name'))
                    ->add()
            ];

            $query = $this->model::query()
                ->whereNot('id', RoleEnum::super->value)
                ->orderBy('id', 'ASC')
                ->select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->json();
        }
        return parent::index();
    }
}
