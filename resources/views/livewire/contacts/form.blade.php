<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-inputs.select name="lead_id" label="{{ __('Lead') }}" :options="App\Models\Lead::withTrashed()->pluck('name', 'id')"/>
    <x-inputs.input type="text" name="name" label="{{ __('Name') }}" validate="true"/>
    <x-inputs.input type="email" name="email" label="{{ __('Email') }}" validate="true"/>
    <x-inputs.input type="tel" name="phone" label="{{ __('Phone') }}" validate="true"/>
    <x-inputs.input type="textarea" name="address" label="{{ __('Address') }}" rows="5" validate="true"/>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
