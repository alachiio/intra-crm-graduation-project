<x-app-layout :title="__('Products')" :has-side-panel="false">
    <x-breadcrumbs :title="__('Products')">
        @can('products.delete')
            <x-slot:popper>
                <x-dropdowns.actions :options="[
                            'create' => '',
                            'trash' => ''
                        ]" :route="'products'"></x-dropdowns.actions>
            </x-slot:popper>
        @endcan
    </x-breadcrumbs>
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <div class="card py-4">
            <x-datatables.table x-data="useDatatable()">
                <x-slot:actions>
                    @unless(request()->has('trashed'))
                        <div class="flex items-center justify-center space-x-3">

                            @can('products.update')
                                <a :href="`/products/${row.id}/edit`" x-tooltip.placement.top="`{{ __('Edit', ['name' => '']) }}`">
                                    <i class="fa-regular fa-pen-to-square text-blue-500"></i>
                                </a>
                            @endcan
                            @can('products.delete')
                                <button type="button"
                                        @click.prevent="document.getElementById('delete-form').setAttribute('action', `/products/${row.id}`);$dispatch('show-modal',
                                    'modal-delete')"
                                        x-tooltip.placement.top="`{{ __('Delete', ['name' => '']) }}`">
                                    <i class="fa-regular fa-trash-can text-red-500"></i>
                                </button>
                            @endcan
                        </div>
                    @else
                        <div class="flex items-center justify-center space-x-3">
                            @can('products.update')
                                <form :action="`/products/${row.id}`" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" x-tooltip.placement.top="`{{ __('Restore', ['name' => '']) }}`"><i class="fa-solid fa-rotate-left text-blue-500"></i></button>
                                </form>
                            @endcan
                            <button type="button"
                                    @click.prevent="document.getElementById('delete-form').setAttribute('action', `/products/${row.id}`);$dispatch('show-modal',
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
    <x-buttons.float-button type="link" href="{{ route('products.create') }}" x-tooltip.placement.top="`{{ __('Add New', ['name' => __('Product')]) }}`">
        <i class="fa-solid fa-plus"></i>
    </x-buttons.float-button>
</x-app-layout>
