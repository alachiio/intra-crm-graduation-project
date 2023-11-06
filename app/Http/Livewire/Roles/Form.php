<?php

namespace App\Http\Livewire\Roles;

use App\Http\Livewire\FormMain;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Form extends FormMain
{
    public $model = Role::class;

    public $permissions = [];

    protected function rules(): array
    {
        return [
            'permissions' => ['nullable']
        ];
    }

    public function mount($params = [])
    {
        parent::mount($params); // TODO: Change the autogenerated stub
        $this->setTitle(__('Create', ['name' => __('Role')]));
        if ($id = request()->route('role')) {
            $this->setEditing($id);
            $this->setTitle(__('Edit', ['name' => __('Role') . ' : ' . $this->editing->name]));
            $this->permissions = $this->editing->permissions()->pluck('name')->toArray();
        }
    }

    protected function afterUpdate($row)
    {
        $this->givePermissions($row);
    }

    public function givePermissions($role)
    {
        $permissions = $this->permissions;
        $permissionsData = Arr::map($this->permissions, function ($item, $key) use ($permissions) {
            return $permissions[$key] = ['name' => $item, 'guard_name' => 'web'];
        });

        Permission::upsert($permissionsData, ['name'], []);

        $role->syncPermissions(Permission::whereIn('name', $permissions)->get());
    }

    protected function saveAndRedirect($route = '')
    {
        $route = 'roles.index';
        parent::saveAndRedirect($route); // TODO: Change the autogenerated stub
    }

    public function render()
    {
        return view('livewire.roles.form');
    }
}
