@php
    $title = __( request()->route('team') ? 'Edit' : 'Create', ['name' => __('Team')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:teams.form/>
    </div>
</x-app-layout>
