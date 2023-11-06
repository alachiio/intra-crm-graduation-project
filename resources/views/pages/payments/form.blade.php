@php
    $title = __( request()->route('payment') ? 'Edit' : 'Create', ['name' => __('Payment')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:payments.form/>
    </div>
</x-app-layout>
