@props([
    'name' => '',
    'teleport' => true
])
<div x-data="{showModal:false}" {{ $attributes }}
x-on:show-modal.window="$event.detail === '{{ $name }}' ? showModal = true : null"
     x-on:close-modal.window="showModal = false"
>
    @php
        $parentOpenTag = ($teleport) ? 'template x-teleport=#x-teleport-target' : 'div';
        $parentCloseTag = ($teleport) ? 'template' : 'div';
    @endphp
    <{{$parentOpenTag}}>
        <div
            class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
            x-show="showModal"
            role="dialog"
            @keydown.window.escape="showModal = false"
        >
            <div
                class="absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
                @click="showModal = false"
                x-show="showModal"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>
            <div
                class="relative max-w-lg rounded-lg bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 sm:px-5"
                x-show="showModal"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                {{ $slot }}
            </div>
        </div>
    </{{$parentCloseTag}}>
</div>
