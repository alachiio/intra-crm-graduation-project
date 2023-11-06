@php
    $title = __( request()->route('product') ? 'Edit' : 'Create', ['name' => __('Product')]);
@endphp
<x-app-layout :title="$title" :has-side-panel="false">
    <x-breadcrumbs :title="$title"></x-breadcrumbs>
    <div class="card w-full p-4">
        <livewire:products.form/>
    </div>
</x-app-layout>
