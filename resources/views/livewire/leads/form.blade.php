<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-inputs.input type="text" name="name" label="{{ __('Name') }}" validate="true"/>
    <x-inputs.input type="tel" name="phone" label="{{ __('Phone') }}" validate="true"/>
    <x-inputs.input type="email" name="email" label="{{ __('Email') }}" validate="true"/>
    <x-inputs.input type="textarea" name="message" label="{{ __('Message') }}"/>
    <x-inputs.select name="campaign_id" label="{{ __('Campaign') }}" validate="true" :options="$params['campaigns']"/>
    <x-inputs.select name="source" label="{{ __('Source') }}" validate="true" :options="$params['lead_sources']"/>
    <x-inputs.select name="country_id" label="{{ __('Country') }}" validate="true" :options="$params['countries']"/>
    <x-inputs.select name="assigned_to" label="{{ __('Assigned') }}" validate="true" :options="$params['users']"/>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
