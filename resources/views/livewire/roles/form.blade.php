<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-templates.table-permissions/>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
