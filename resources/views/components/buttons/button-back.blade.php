@php
    $classes = 'shadow-sm inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="bx bx-arrow-to-left leading-tight rtl:rotate-180 me-2"></i> {{ __('strings.back') }}
</a>
