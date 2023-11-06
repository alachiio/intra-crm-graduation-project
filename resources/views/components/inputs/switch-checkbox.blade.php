<div {{ $attributes->merge(['class' => 'mb-3'])->only(['class']) }}>
    <label class="inline-flex items-center space-x-2 cursor-pointer">
        <input
            class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300
            dark:checked:bg-accent dark:checked:before:bg-white" name="{{ $name }}" wire:model.defer="{{$name}}"
            type="checkbox"  @if($value) value="{{ $value }}" @endif {{ $attributes->except(['class']) }}
        />
        <span>{{ $label }}</span>
    </label>
    @if($validate)
        @error($name) <span class="text-tiny+ text-error">{{ $message }}</span> @enderror
    @endif
</div>
