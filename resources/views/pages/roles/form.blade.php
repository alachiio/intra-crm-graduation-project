@php
    $title = __( request()->route('role') ? 'Edit' : 'Create', ['name' => __('Role')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:roles.form/>
    </div>
</x-app-layout>
