<x-forms.form :title="''" class="p-4" type="livewire">
    <x-inputs.input name="current_pin_code" type="text"
                    label="{{ __('Current Pin Code') }}"
                    :placeholder="false"
                    x-mask="99999"></x-inputs.input>
    <x-inputs.input name="pin_code" type="text"
                    label="{{ __('New Pin Code') }}"
                    :placeholder="false"
                    x-mask="99999"></x-inputs.input>
    <x-inputs.input name="pin_code_confirmation" type="text"
                    label="{{ __('Repeat New Pin Code') }}"
                    :placeholder="false"
                    x-mask="99999"></x-inputs.input>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
