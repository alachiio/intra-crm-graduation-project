@props([
    'name' => 'modal-delete',
])
<x-modals.backdrop-shadow name="{{ $name }}">
    <form id="delete-form" action="" method="POST">
        @csrf @method('DELETE')
        <div class="p-6">
            <h3 class="text-center font-semibold text-lg">{{ __('Are you sure you want to', ['name' => __('Delete', ['name' => ''])]) }}</h3>
            <div class="mt-4 flex items-center justify-center space-x-3">
                <x-buttons.button type="button" @click="$dispatch('close-modal')" class="w-32 bg-slate-200">
                    {{ __('No') }}
                </x-buttons.button>
                <x-buttons.button type="submit" class="w-32 bg-red-500 hover:bg-red-600 text-white">
                    {{ __('Yes') }}
                </x-buttons.button>
            </div>
        </div>
    </form>
</x-modals.backdrop-shadow>
