<?php

namespace App\Http\Controllers;

use App\Enums\BooleanEnum;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\Forms\Select\FormSelect;
use Omarashi\LaravelDatatables\LaravelDatatables;

class CampaignController extends BaseController
{
    protected $model = Campaign::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = [
                'campaigns.id',
                'campaigns.name',
                'campaigns.reference_hash',
                DB::raw('CONCAT(users.f_name, " ", users.l_name) as team_leader'),
                'campaigns.is_active',
                'campaigns.created_at',
            ];
            $columns = [
                Column::name('name')
                    ->title(__('Name'))
                    ->add(),
                Column::name('leads_count')
                    ->title(__('Leads Count'))
                    ->orderable(false)
                    ->add(),
                Column::name('reference_hash')
                    ->title(__('Reference'))
                    ->orderable(false)
                    ->add(),
                Column::name('team_leader')
                    ->title(__('Team Leader'))
                    ->orderable(false)
                    ->add(),
                Column::name('is_active as active')
                    ->title(__('Active'))
                    ->editable(FormSelect::create(BooleanEnum::dropdown()))
                    ->add(),
                Column::name('created_at as created')
                    ->title(__('Created at'))
                    ->add(),
            ];

            $query = $this->model::query()
                ->leftJoin('users', 'campaigns.assigned_to', '=', 'users.id')
                ->select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->exceptFromSearch(['leads_count'])->json();
        }
        return parent::index();
    }
}
