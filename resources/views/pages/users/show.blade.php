<x-app-layout :title="__('Users')" :has-side-panel="false">
    <x-breadcrumbs :title="__('Show', ['name' => __('User').' : '. $row->name])"></x-breadcrumbs>
    <livewire:users.show :row="$row"></livewire:users.show>
</x-app-layout>
