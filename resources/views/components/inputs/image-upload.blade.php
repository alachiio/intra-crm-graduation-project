<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label> {{ $label }} </label>
    <div class="flex gap-3 items-center">
        <label for="{{ $name }}" class="btn-image-upload">
            {{ __('strings.upload') }}
        </label>
        <x-spinners.circle :target="$name" class="w-10 text-tawrid-secondary-100"></x-spinners.circle>
    </div>
    <div class="input">
        <input id="{{ $name }}" type="file" accept="image/png, image/jpg, image/jpeg, image/svg" name="{{ $name }}"
               wire:model.defer="{{ $name }}" class="hidden @if($validate) has-validation @endif" @change="$dispatch('upload')">
        @if($validate)
            @error($name) <span class="error">{{ $message }}</span> @enderror
        @endif
    </div>
    @if($image)
        <div class="relative w-48">
            @if(is_string($image))
                <x-modals.modal>
                    <x-slot name="button">
                        <x-buttons.button type="button" x-on:click="open = true"
                                          class="absolute top-0 right-0 pt-2 pe-2 text-red-700 font-bold text-2xl">
                            &times;
                        </x-buttons.button>
                    </x-slot>
                    <x-slot name="header">
                        <h3 class="text-red-600 text-lg">{{ __('messages.are_you_sure') }}</h3>
                    </x-slot>
                    <div class="mt-4">
                        <span class="mr-2">
                            <x-buttons.button type="button" x-on:click="open = false" class="w-32 bg-gray-200">
                                {{ __('strings.no') }}
                            </x-buttons.button>
                        </span>
                        <span>
                            <x-buttons.button type="button" wire:click="unlinkFile('{{ $name }}')"
                                              class="w-32 bg-red-600 text-white">
                                {{ __('strings.yes') }}
                            </x-buttons.button>
                        </span>
                    </div>
                </x-modals.modal>
                <img src="{{ asset('storage/'.$image) }}" class="w-full">
            @else
                <img id="img-{{$name}}" src="{{ $image->temporaryUrl() }}" class="w-60">

                {{--                <x-modals.modal x-data="{--}}
                {{--                open : false,--}}
                {{--                cropper: '',--}}
                {{--                setUp() {--}}
                {{--                     this.cropper = new Cropper(document.getElementById('img-{{$name}}'), {--}}
                {{--                        aspectRatio: 1/1,--}}
                {{--                        autoCropArea: 0.5,--}}
                {{--                        viewMode: 3,--}}
                {{--                        crop(event) {--}}
                {{--                            console.log(event.detail)--}}
                {{--                        }--}}
                {{--                    });--}}
                {{--                    this.open = true;--}}
                {{--                },--}}
                {{--                close() {--}}
                {{--                    this.open = false;--}}
                {{--                    this.cropper.destroy();--}}
                {{--                }--}}
                {{--            }" x-init="setUp()">--}}
                {{--                    <x-slot name="header">--}}
                {{--                        <h3 class="text-red-600 text-lg">{{ __('messages.crop_image') }}</h3>--}}
                {{--                    </x-slot>--}}
                {{--                    <div>--}}
                {{--                        <img id="img-{{$name}}" src="{{ $image->temporaryUrl() }}" class="w-60">--}}
                {{--                        <span class="block mt-4">--}}
                {{--                        <x-buttons.button type="button"--}}
                {{--                                          class="w-32 bg-red-600 text-white" @click="console.log(cropper.getCroppedCanvas().toDataURL('image/jpeg'))">--}}
                {{--                            {{ __('strings.crop') }}--}}
                {{--                        </x-buttons.button>--}}
                {{--                    </span>--}}
                {{--                    </div>--}}
                {{--                </x-modals.modal>--}}
            @endif
        </div>
    @endif
</div>
