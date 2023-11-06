<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\LaravelDatatables;

class TeamController extends BaseController
{
    protected $model = Team::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = [
                'teams.id',
                DB::raw('CONCAT(users.f_name, " ", users.l_name) as leader'),
                'teams.created_at as created_at'
            ];
            $columns = [
                Column::name('leader')
                    ->title(__('Leader'))
                    ->add(),
                Column::name('created')
                    ->title(__('Created at'))
                    ->add()
            ];

            $query = $this->model::query()
                ->with(['users' => function ($q) {
                    return $q->limit(3);
                }])
                ->leftJoin('users', 'teams.leader_id', '=', 'users.id')
                ->select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->json();
        }
        return parent::index();
    }
}
