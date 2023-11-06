@php
    $classes = 'shadow-sm inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150';

    if(!$attributes->has('type')) {
        $attributes = $attributes->merge(['type' => 'button']);
    }
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
