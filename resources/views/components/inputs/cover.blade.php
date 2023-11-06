<div {{ $attributes }}>
    @if(isset($label))
        <h3 class="text-gray-700 font-bold mb-1">{{ $label }}</h3>
    @endif
    <label
        for="{{ $name }}"
        class="cursor-pointer grow overflow-hidden"
    >
        <div class="flex justify-center items-center w-full h-full border rounded relative bg-gray-100 shadow-inset">
            <div wire:loading.remove wire:target="{{ $name }}" class="absolute w-full h-full bg-gray-700 rounded opacity-0 hover:opacity-75 text-white flex justify-center items-center">
                {{ __('Upload') }}
            </div>
            <x-spinners.circle :target="$name" class="w-10 text-tawrid-secondary-100"></x-spinners.circle>
            <div wire:loading.remove wire:target="{{ $name }}" class="object-cover w-full h-full rounded flex justify-center items-center">
                @if($image)
                    <div class="h-full">
                        <img id="img-{{$name}}" src="{{ (is_string($image)) ? asset($image) : $image->temporaryUrl() }}" class="object-cover h-full rounded">
                        <button type="button" class="text-red-500 text-2xl absolute top-0 right-0 bg-white px-1 pt-1 pb-0.5 rounded-full border hover:text-white hover:bg-red-500 transition"
                                wire:click="unlinkFile('{{ $name }}')"><i class="fa-solid fa-times"></i></button>
                    </div>
                @else
                    <span class="fa-solid fa-image text-gray-500 text-6xl"></span>
                @endif
            </div>
        </div>
    </label>
    <input id="{{ $name }}" type="file" accept="image/png, image/jpg, image/jpeg, image/svg" name="{{ $name }}"
           wire:model.defer="{{ $name }}" class="hidden @if($validate) has-validation @endif" @change="$dispatch('upload')">
    @if($validate)
        @error($name) <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
    @endif
</div>
