<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Team;
use App\Models\User;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\Forms\Select\FormSelect;
use Omarashi\LaravelDatatables\LaravelDatatables;

class UserController extends BaseController
{
    protected $model = User::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {
            $select = [
                'users.id',
                'users.user_id',
                'users.f_name',
                'users.l_name',
                'users.email',
                'users.phone',
                'users.profile_photo_path',
                'users.account_status'
            ];
            $columns = [
                Column::name('profile_photo_path as avatar')
                    ->html('<img class="w-10 h-10 rounded-full" src="{val}" />')
                    ->add(),
                Column::name('user_id')
                    ->title(__('User ID'))
                    ->add(),
                Column::name('f_name')
                    ->title('First Name')
                    ->add(),
                Column::name('l_name')
                    ->title('Last Name')
                    ->add(),
                Column::name('email')
                    ->title('Email')
                    ->add(),
                Column::name('phone')
                    ->title('Phone')
                    ->add(),
                Column::name('account_status as status')
                    ->title('Status')
                    ->editable(
                        FormSelect::create(User::getAccountStatusDropdown())
                    )
                    ->add(),
            ];

            $query = User::query();
            if (auth()->user()->hasRole('team_leader') and auth()->user()->team)
                $query = $query->where('current_team_id', auth()->user()->team->id);
            $query = $query->whereNot('id', auth()->id())->notSuperAdmin()->select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)
                ->columns($columns)
                ->json();
        }
        return parent::index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
        $this->data['params']['account_statuses'] = User::getAccountStatusDropdown();
//        Role::where('id', '>', auth()->user()->roles[0]->id)->pluck('name', 'id')
        $this->data['params']['roles'] = RoleEnum::from(auth()->user()->roles[0]->id)->dropdown();
        $this->data['params']['teams'] = Team::all()->pluck('leader.name', 'id')->map(function ($leader) {
            return __('Team of', ['name' => $leader]);
        });
        return parent::form();
    }
}
