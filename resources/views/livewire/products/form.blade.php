<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-inputs.cover name="cover" label="{{ __('Cover') }}"
                    :image="$this->files['cover']"
                    class="mb-3 w-1/4 flex flex-col h-48" validate="true"></x-inputs.cover>
    <x-inputs.input type="text" name="name" label="{{ __('Name') }}" validate="true"/>
    <x-inputs.input type="textarea" name="description" label="{{ __('Description') }}" rows="5" validate="true"/>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
