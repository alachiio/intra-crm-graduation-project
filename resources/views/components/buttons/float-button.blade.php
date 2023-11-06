@php
    use Illuminate\Support\Str;
    if(!Str::contains($attributes['class'], ['text-', 'bg-']))
        $attributes = $attributes->merge(['class' => 'bg-primary text-white hover:shadow-primary/50']);
    $attributes = $attributes->merge(['class' => 'fixed ltr:right-10 rtl:left-10 bottom-10 hover:shadow-lg w-12 h-12 flex items-center justify-center rounded-full']);
@endphp
@unless($attributes['type'] === 'link')
    <button {{ $attributes }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->except('type') }}>
        {{ $slot }}
    </a>
@endif
