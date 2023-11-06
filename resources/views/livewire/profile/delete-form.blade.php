<x-forms.form :title="''" class="p-4" type="livewire">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete your account?') }}
    </h2>
    <div class="mt-6">
        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only"/>
        <x-inputs.input name="password" type="password"
                        label="{{ __('Password') }}"
                        placeholder="true"
                        validate="true"></x-inputs.input>
    </div>

    <div class="mt-6 flex justify-end">
        <x-secondary-button class="ltr:mr-3 rtl:ml-3" x-on:click="$dispatch('close-modal', 'confirm_account_closing_modal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-buttons.button-loading class="w-36 h-10 !bg-error dark:!bg-error-focus focus:!bg-red-800" type="submit">
            {{ __('Confirm')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
