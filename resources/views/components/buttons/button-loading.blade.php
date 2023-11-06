@php
    $classes = 'shadow-sm inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary
    hover:bg-primary focus:outline-none focus:border-tawrid-primary-200 focus:shadow-outline-teal active:bg-secondary transition ease-in-out duration-150';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    <x-spinners.circle target="{{$attributes['target'] ?? 'submit'}}" class="text-white h-5"></x-spinners.circle>
    {{ $slot }}
</button>
