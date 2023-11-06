@php
    $inputClasses = 'grow';
    if($validate) {
        $inputClasses.= ' has-validation';
    }
@endphp

<div {{ $attributes->merge(['class' => 'mb-3'])->except('x-init') }}>
    <div wire:ignore>
        <label for="{{ $name }}" class="flex -space-x-px @if($placeholder) has-placeholder @endif">
            @if(!$placeholder)
                <div
                    class="flex w-fit items-center justify-center ltr:rounded-l-lg rtl:rounded-r-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450">
                    <span>{!! $label !!}</span>
                </div>
            @endif
            <select
                id="{{ $name }}" class="{{ $inputClasses }}" name="{{ $name }}"
                @if($mode != 'static') wire:model.{{$mode}}="{{ $name }}" @endif
                @if($attributes->has('x-init'))
                    {{ $attributes->only(['x-init']) }}
                @else
                    x-init="$el._tom = new Tom($el,{
                            create: false
                        })"
                @endif
                @if($multiple) multiple @endif>
                <option value="" selected hidden>{{ $label }}</option>
                @foreach($options as $id => $option)
                    <option value="{{ $id }}">{{ $option }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <input type="hidden" wire:model.{{$mode}}="{{ $name }}">
    @if($validate)
        @error($name) <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
    @endif
</div>
