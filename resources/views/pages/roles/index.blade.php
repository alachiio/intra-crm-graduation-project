<x-app-layout :title="__('Roles')" :has-side-panel="false">
    <x-breadcrumbs :title="__('Roles')"></x-breadcrumbs>
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <div class="card py-4">
            <x-datatables.table x-data="useDatatable()">
                @can('roles.update')
                    <x-slot:actions>
                        <div class="flex items-center justify-center space-x-3">
                            <a :href="`/roles/${row.id}/edit`" x-tooltip.placement.top="`{{ __('Edit', ['name' => '']) }}`">
                                <i class="fa-regular fa-pen-to-square text-blue-500"></i>
                            </a>
                        </div>
                    </x-slot:actions>
                @endcan
            </x-datatables.table>
        </div>
    </div>
</x-app-layout>
