<x-app-layout :title="__('Teams')" :has-side-panel="false">
    <x-breadcrumbs :title="__('Teams')">
        @can('teams.delete')
            <x-slot:popper>
                <x-dropdowns.actions :options="[
                            'create' => '',
                            'trash' => ''
                        ]" :route="'teams'"></x-dropdowns.actions>
            </x-slot:popper>
        @endcan
    </x-breadcrumbs>
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <div class="card py-4">
            <x-datatables.table x-data="useDatatable()">
                <x-slot:columns>
                    <th>
                        <div class="flex p-3">
                            {{ __('Members') }}
                        </div>
                    </th>
                </x-slot:columns>
                <td>
                    <div class="flex p-4">
                        <template x-for="member in row.users">
                            <img class="w-8 h-8 rounded-full ltr:-ml-2 rtl:-mr-2" :src="member.avatar" :key="member.user_id" x-tooltip.placement.bottom="member.name"/>
                        </template>
                        <template x-if="row.users.length">
                            <div class="ltr:-ml-2 rtl:-mr-2 w-8 h-8 rounded-full bg-slate-200 dark:bg-navy-600 flex justify-center items-center">...</div>
                        </template>
                    </div>
                </td>
                <x-slot:actions>
                    @unless(request()->has('trashed'))
                        <div class="flex items-center justify-center space-x-3">
                            @can('teams.update')
                                <a :href="`/teams/${row.id}/edit`" x-tooltip.placement.top="`{{ __('Edit', ['name' => '']) }}`">
                                    <i class="fa-regular fa-pen-to-square text-blue-500"></i>
                                </a>
                            @endcan
                            @can('teams.delete')
                                <button type="button"
                                        @click.prevent="document.getElementById('delete-form').setAttribute('action', `/teams/${row.id}`);$dispatch('show-modal',
                                    'modal-delete')"
                                        x-tooltip.placement.top="`{{ __('Delete', ['name' => '']) }}`">
                                    <i class="fa-regular fa-trash-can text-red-500"></i>
                                </button>
                            @endcan
                        </div>
                    @else
                        <div class="flex items-center justify-center space-x-3">
                            @can('teams.update')
                                <form :action="`/teams/${row.id}`" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" x-tooltip.placement.top="`{{ __('Restore', ['name' => '']) }}`"><i class="fa-solid fa-rotate-left text-blue-500"></i></button>
                                </form>
                            @endcan
                            <button type="button"
                                    @click.prevent="document.getElementById('delete-form').setAttribute('action', `/teams/${row.id}`);$dispatch('show-modal',
                                    'modal-delete')"
                                    x-tooltip.placement.top="`{{ __('Permanently Delete', ['name' => '']) }}`">
                                <i class="fa-regular fa-trash-can text-red-500"></i>
                            </button>
                        </div>
                    @endunless
                </x-slot:actions>
            </x-datatables.table>
        </div>
    </div>
    <x-buttons.float-button type="link" href="{{ route('teams.create') }}" x-tooltip.placement.top="`{{ __('Add New', ['name' => __('Team')]) }}`">
        <i class="fa-solid fa-plus"></i>
    </x-buttons.float-button>
</x-app-layout>
