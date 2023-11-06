<x-app-layout :has-side-panel="false" :title="__('Show', ['name' => __('City')])">
    <x-breadcrumbs :title="__('Show', ['name' => __('City').' : '. $row->name])"></x-breadcrumbs>
    <div class="card w-full p-4 mt-4">
        <div class="flex items-center w-full">
            <div class="grid grid-cols-2 gap-4 flex-1">
                <div>{{ __('Name') }}</div>
                <div>{{ $row->name }}</div>
            </div>
            <x-buttons.float-button type="link" href="{{ route('settings.cities.edit', $row->slug) }}" x-tooltip.placement.top="`{{ __('Edit', ['name' => __('City')]) }}`">
                <i class="fa-solid fa-pencil text-xl"></i>
            </x-buttons.float-button>
        </div>
    </div>
</x-app-layout>
