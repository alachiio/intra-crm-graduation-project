@php
    $inputClasses = 'form-input grow border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10
    focus:border-primary
            dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent';

    $inputClasses .= ($placeholder) ? ' rounded-lg' : ' ltr:rounded-r-lg rtl:rounded-l-lg';

    if($validate) {
        $inputClasses.= ' has-validation';
    }
@endphp

<div {{ $attributes->merge(['class' => 'mb-3'])->only(['x-ref', 'x-show', '@keydown.tab', 'class']) }}>
    <label for="{{ $name }}" class="flex -space-x-px">
        @if(!$placeholder)
            <div
                class="flex w-fit items-center justify-center ltr:rounded-l-lg rtl:rounded-r-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450">
                <span>{!! $label !!}</span>
            </div>
        @endif
        @if($type == 'textarea')
            <textarea id="{{ $name }}" class="{{ $inputClasses.' '. $attributes['input-class'] }}" name="{{ $name }}" @if($mode != 'static') wire:model.{{$mode}}="{{ $name }}" @endif
            @if($placeholder) placeholder="{{ $label }}" @endif {{ $attributes->except(['x-ref', 'x-show', '@keydown.tab', 'class']) }}>@if($value){{ $value }}@endif</textarea>
        @else
            <input id="{{ $name }}" type="{{ $type }}" class="{{ $inputClasses.' '. $attributes['input-class'] }}" name="{{ $name }}" @if($mode != 'static') wire:model.{{$mode}}="{{ $name }}" @endif
            @if($placeholder) placeholder="{{ $label }}" @endif
                   @if($value) value="{{ $value }}" @endif {{ $attributes->except(['x-ref', 'x-show', '@keydown.tab', 'class']) }}>
        @endif
        {{ $slot }}
    </label>
    @if($validate)
        @error($name) <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
    @endif
</div>
