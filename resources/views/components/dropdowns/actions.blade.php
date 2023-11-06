@props(['options' => [
        'show' => '',
        'edit' => '',
        'destroy' => ''
    ],
    'route' => '',
    'placement' => 'bottom-start',
    'class' => 'btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'])
<div x-data="usePopper({ placement: '{{ $placement }}', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
     class="inline-flex" wire:ignore>
    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
            class="{{ $class }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
        </svg>
    </button>

    <div x-ref="popperRoot" class="popper-root actions" :class="isShowPopper && 'show'">
        <div
            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
            <ul>
                @if(array_key_exists('create', $options))
                    <li>
                        <a href="{{ route($route.'.create') }}">
                            <i class="fa-solid fa-plus text-primary"></i>
                            <span>{{ __('Add new', ['name' => '']) }}</span>
                        </a>
                    </li>
                @endif
                @if(array_key_exists('show', $options))
                    <li>
                        <a href="{{ route($route.'.show', $options['show']) }}">
                            <i class="fa-regular fa-eye text-yellow-500"></i>
                            <span>{{ __('Show', ['name' => '']) }}</span>
                        </a>
                    </li>
                @endif
                @if(array_key_exists('edit', $options))
                    <li>
                        <a href="{{ route($route.'.edit', $options['edit']) }}">
                            <i class="fa-solid fa-pen-to-square text-blue-500"></i>
                            <span>{{ __('Edit', ['name' => '']) }}</span>
                        </a>
                    </li>
                @endif
                @if(array_key_exists('destroy', $options))
                    <li>
                        <button type="button"
                                @click.prevent="document.getElementById('delete-form').setAttribute('action', `{{ route($route.'.destroy', $options['destroy']) }}`); $dispatch('show-modal',
                                'modal-delete'); isShowPopper = false">
                            <i class="fa-regular fa-trash-can text-red-500"></i>
                            <span>{{ __('Delete', ['name' => '']) }}</span>
                        </button>
                    </li>
                @endif
                @if(array_key_exists('trash', $options))
                    <li>
                        <a href="{{ route($route.'.index').'?trashed=1' }}">
                            <i class="fa-solid fa-recycle text-red-500"></i>
                            <span>{{ __('Trash') }}</span>
                        </a>
                    </li>
                @endif
                {{ $slot }}
            </ul>
        </div>
    </div>
</div>
