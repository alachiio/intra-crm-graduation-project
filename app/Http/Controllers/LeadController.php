<?php

namespace App\Http\Controllers;

use App\Enums\LeadSourceEnum;
use App\Enums\LeadStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\Forms\Select\FormSelect;
use Omarashi\LaravelDatatables\LaravelDatatables;

class LeadController extends BaseController
{
    protected $model = Lead::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = [
                'leads.id',
                'leads.name',
                'leads.phone',
                'leads.email',
                'countries.meta->name->common as country',
                'campaigns.name as campaign',
                DB::raw('CONCAT(users.f_name, " ", users.l_name) as assigned'),
                'leads.status'
            ];

            $columns = [
                Column::name('status as lead_status')
                    ->title(__('Status'))
                    ->editable(FormSelect::create(LeadStatusEnum::dropdown()))
                    ->add(),
                Column::name('name')
                    ->title(__('Name'))
                    ->add(),
                Column::name('phone')
                    ->title(__('Phone'))
                    ->add(),
                Column::name('email')
                    ->title(__('Email'))
                    ->add(),
                Column::name('country')
                    ->title(__('Country'))
                    ->add(),
                Column::name('campaign')
                    ->title(__('Campaign'))
                    ->add(),
                Column::name('assigned')
                    ->title(__('Assigned'))
                    ->add(),
                Column::name('created_at as created')
                    ->title(__('Created at'))
                    ->add(),
            ];

            $query = $this->model::query();
            if (auth()->user()->hasRole('consultant'))
                $query = $query->where('assigned_to', auth()->id());
            $query = $query
                ->leftJoin('countries', 'leads.country_id', '=', 'countries.id')
                ->leftJoin('campaigns', 'leads.campaign_id', '=', 'campaigns.id')
                ->leftJoin('users', 'leads.assigned_to', '=', 'users.id')
                ->select($select);
            if (request()->has('trashed') and !auth()->user()->hasRole('consultant'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->json();
        }
        return parent::index();
    }

    public function move($lead)
    {
        $lead = Lead::find($lead);
        Contact::create([
            'lead_id' => $lead->id,
            'name' => $lead->name,
            'phone' => $lead->phone,
            'email' => $lead->email,
        ]);

        $lead->delete();

        session()->flash('toast', ['icon' => 'success', 'message' => 'Lead moved to contacts successfully']);
        return back();
    }

    protected function form()
    {
        $this->data['params']['campaigns'] = Campaign::pluck('name', 'id');
        $this->data['params']['lead_sources'] = LeadSourceEnum::dropdown();
        $this->data['params']['countries'] = Country::dropdown();
        $this->data['params']['users'] = User::notSuperAdmin()->active()->whereHas('roles', function ($q) {
            return $q->where('id', RoleEnum::consultant->value);
        })->get()->pluck('name', 'id');
        return parent::form(); // TODO: Change the autogenerated stub
    }
}