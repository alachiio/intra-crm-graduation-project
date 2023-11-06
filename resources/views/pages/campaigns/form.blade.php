@php
    $title = __( request()->route('campaign') ? 'Edit' : 'Create', ['name' => __('Campaign')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:campaigns.form/>
    </div>
</x-app-layout>
