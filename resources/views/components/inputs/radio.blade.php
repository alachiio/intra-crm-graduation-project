@php
    $css = '';
    switch ($attributes->get('class')) {
        case 'accent':
            $css = 'checked:!border-accent checked:!bg-accent hover:!border-accent  focus:!border-accent';
            break;
        case 'success':
            $css = 'checked:!border-success checked:!bg-success hover:!border-success  focus:!border-success';
            break;
        case 'warning':
            $css = 'checked:!border-warning checked:!bg-warning hover:!border-warning  focus:!border-warning';
            break;
        case 'error':
            $css = 'checked:!border-error checked:!bg-error hover:!border-error  focus:!border-error';
            break;
        default:
            $css = 'checked:!border-primary checked:!bg-primary hover:!border-primary  focus:!border-primary';
    }
@endphp

<div {{ $attributes->merge(['class' => 'mb-3'])->only(['class']) }}>
    <label class="inline-flex items-center space-x-2 cursor-pointer">
        {{--        <input--}}
        {{--            checked--}}
        {{--            class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-slate-500 checked:bg-slate-500 hover:border-slate-500 focus:border-slate-500 dark:border-navy-400 dark:checked:bg-navy-400"--}}
        {{--            name="{{ $name }}" wire:model.defer="{{$name}}"--}}
        {{--            type="radio"--}}
        {{--        />--}}
        <input
            class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 {{ $css }} dark:border-navy-400 dark:checked:bg-navy-400"
            name="{{ $name }}" wire:model.defer="{{$name}}"
            type="radio" @if($value !== null) value="{{ $value }}" @endif {{ $attributes->except(['class']) }}
        />
        <p>{{ $label }}</p>
    </label>
    @if($validate)
        @error($name) <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
    @endif
</div>
