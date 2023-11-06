<?php

class MainSidebar
{
    public static function render()
    {
        return [
            [
                'title' => __('Dashboard'),
                'icon' => 'fa-solid fa-gauge-high',
                'url' => route('index'),
                'resource' => 'index',
            ],
            [
                'title' => __('Roles & Permissions'),
                'icon' => 'fa-solid fa-lock',
                'url' => route('roles.index'),
                'resource' => 'roles',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('roles.view')
            ],
            [
                'title' => __((auth()->user()->hasRole('team_leader')) ? 'Team' : 'Users'),
                'icon' => 'fa-solid fa-user-gear',
                'url' => route('users.index'),
                'resource' => 'users',
                'conditions' => auth()->user()->hasAnyRole(['super', 'team_leader']) or auth()->user()->can('users.view'),
            ],
            [
                'title' => __('Teams'),
                'icon' => 'fa-solid fa-users-rectangle',
                'url' => route('teams.index'),
                'resource' => 'teams',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('teams.view'),
            ],
            [
                'title' => __('Leads'),
                'icon' => 'fa-solid fa-filter',
                'url' => route('leads.index'),
                'resource' => 'leads',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('leads.view')
            ],
            [
                'title' => __('Contacts'),
                'icon' => 'fa-solid fa-address-book',
                'url' => route('contacts.index'),
                'resource' => 'contacts',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('contacts.view')
            ],
            [
                'title' => __('Products'),
                'icon' => 'fa-brands fa-product-hunt',
                'url' => route('products.index'),
                'resource' => 'products',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('products.view')
            ],
            [
                'title' => __('Campaigns'),
                'icon' => 'fa-solid fa-bullhorn',
                'url' => route('campaigns.index'),
                'resource' => 'campaigns',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('campaigns.view')
            ],
            [
                'title' => __('Payments'),
                'icon' => 'fa-solid fa-file-invoice-dollar',
                'url' => route('payments.index'),
                'resource' => 'payments',
                'conditions' => auth()->user()->hasRole('super') or auth()->user()->can('payments.view')
            ],
        ];
    }
}
