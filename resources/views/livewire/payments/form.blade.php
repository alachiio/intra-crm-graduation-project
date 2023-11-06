<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-inputs.select name="contact_id" label="{{ __('Contact') }}" :options="App\Models\Contact::pluck('name', 'id')" validate="true"/>
    <x-inputs.input type="number" name="amount" label="{{ __('Amount') }}" validate="true"/>
    <x-inputs.input type="text" name="note" label="{{ __('Note') }}" validate="true"/>
    <x-inputs.select name="status" label="{{ __('Confirmed') }}" :options="App\Enums\BooleanEnum::dropdown()" validate="true"/>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>

