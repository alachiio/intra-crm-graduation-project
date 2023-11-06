<x-app-layout :title="__('Profile')" :has-side-panel="false">
    <x-breadcrumbs :title="__('Profile')"></x-breadcrumbs>
    <livewire:profile.edit :user="$user"/>
</x-app-layout>
