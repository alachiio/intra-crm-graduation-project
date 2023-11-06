<div {{ $attributes }}>
    <label
        for="{{ $name }}"
        class="cursor-pointer"
    >
        <div class="flex justify-center items-center w-32 h-32 mx-auto border-2 border-dashed border-slate-300 rounded-full relative shadow-inset">
            <div wire:loading.remove wire:target="{{ $name }}" class="absolute w-full h-full bg-gray-700 rounded-full opacity-0 hover:opacity-75 text-white flex justify-center items-center">
                {{ __('Upload') }}
            </div>
            <x-spinners.circle :target="$name" class="w-10"></x-spinners.circle>
            <div wire:loading.remove wire:target="{{ $name }}" class="object-cover w-full h-full rounded-full flex justify-center items-center">
                @if($image)
                    <div>
                        <img id="img-{{$name}}" src="{{ (is_string($image)) ? asset($image) : $image->temporaryUrl() }}" class="object-cover w-full rounded-full">
                        <button type="button" class="text-red-500 absolute top-0 right-0 bg-white rounded-full border hover:text-white hover:bg-red-500 transition table-cell w-7 h-7 text-center
                        align-middle"
                                wire:click="unlinkFile('{{ $name }}')"><i class="fa-solid fa-times"></i></button>
                    </div>
                @else
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8 fill-none stroke-slate-400' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12'/>
                    </svg>
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
