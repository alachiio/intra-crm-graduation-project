@php
    $title = __( request()->route('lead') ? 'Edit' : 'Create', ['name' => __('Lead')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:leads.form :params="$params"/>
    </div>
</x-app-layout>
