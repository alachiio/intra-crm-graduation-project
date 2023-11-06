@php
    $title = __( request()->route('user') ? 'Edit' : 'Create', ['name' => __('User')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <livewire:users.form :params="$params"/>
</x-app-layout>
