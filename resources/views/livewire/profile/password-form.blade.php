<x-forms.form :title="''" class="p-4" type="livewire">
    <x-inputs.input name="current_password" type="password"
                    label="{{ __('Current Password') }}"
                    :placeholder="false"
                    validate="true"></x-inputs.input>
    <x-inputs.input name="password" type="password"
                    label="{{ __('New Password') }}"
                    :placeholder="false"
                    validate="true"></x-inputs.input>
    <x-inputs.input name="password_confirmation" type="password"
                    label="{{ __('Repeat New Password') }}"
                    :placeholder="false"
                    validate="true"></x-inputs.input>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
