@props(['title' => __('General') ])
<x-app-layout :title="__('Settings').' - '. $title" :side-panel="SidebarPanel::settings()" :is-sidebar-open="true" :has-side-panel-toggle="false">
    @isset($head)
        <x-slot name="head">
            {{ $head }}
        </x-slot>
    @endisset

    {{ $slot }}

    @isset($scripts)
        <x-slot name="scripts">
            {{ $scripts }}
        </x-slot>
    @endisset
</x-app-layout>
