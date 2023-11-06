<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\LaravelDatatables;

class ProductController extends BaseController
{
    protected $model = Product::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = ['id', 'name', 'description', 'cover', 'created_at'];
            $columns = [
                Column::name('cover as cover_photo')
                    ->html('<div class="w-14"><img class="w-10 h-10 rounded-full" src="{val}" /></div>')
                    ->add(),
                Column::name('name')
                    ->title(__('Name'))
                    ->add(),
                Column::name('description')
                    ->title(__('Description'))
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
