<div {{ $attributes->except(['type'])->merge(['class' => 'relative']) }}>
    <x-spinners.circle class="fixed bottom-10 ltr:right-10 rtl:left-10 w-10 h-10" target="submit"></x-spinners.circle>
    @if(isset($title) and $title !== 'hidden')
        <div class="flex items-baseline mb-10">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200 text-2xl text-center w-full">{{ $title }}</h3>
        </div>
    @endif
    @if(session()->has('toast'))
        @if(session('toast')['icon'] == 'error')
            <div class="text-tiny text-error mb-5">
                {{ session('toast')['message'] }}
            </div>
        @endif
    @endif
    @if(isset($tabs))
        {!! $tabs !!}
    @endif
    <form @if($attributes['type'] == 'livewire') wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))" @else
        {{ $attributes->only(['method', 'action', 'enctype']) }}
        @endif>
        {{ $slot }}
    </form>
</div>
