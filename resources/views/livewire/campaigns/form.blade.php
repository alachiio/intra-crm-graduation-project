<x-forms.form :title="$title" class="p-4" type="livewire">
    <x-inputs.input type="text" name="name" label="{{ __('Name') }}" validate="true"/>
    <x-inputs.select name="is_active" label="{{ __('Active') }}" :options="App\Enums\BooleanEnum::dropdown()"/>
    <x-inputs.select name="products" label="{{ __('Products') }}" :options="App\Models\Product::pluck('name', 'id')" :multiple="true"></x-inputs.select>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
