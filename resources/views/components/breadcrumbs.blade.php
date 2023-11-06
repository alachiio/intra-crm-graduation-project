<div {{ $attributes->merge(['class' => 'flex items-center space-x-4 py-5 lg:py-6 w-full']) }}>
    <div class="flex items-center space-x-3">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ $title }}
        </h2>
        @isset($popper)
            {{ $popper }}
        @endisset
    </div>
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="flex items-center space-x-2 sm:flex grow">
        <li class="flex items-center ltr:mr-2 rtl:ml-2 space-x-2 rtl:space-x-reverse">
            <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
               href="{{ url('/') }}">{{ __('Dashboard') }}</a>
            <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rtl:transform rtl:rotate-180" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </li>
        @foreach($items as $index => $item)
            @php
                if(is_numeric($item)) {
                    $model = request()->route()->getController()->getModel();
                    $itemName = $model::find($item)->{$model::$breadcurmbs};
                } else {
                    $itemName = ucwords(str_replace(['-', '_'], ' ', $item));
                }
            @endphp
            @unless($loop->last)
                <li class="flex items-center ltr:mr-2 rtl:ml-2 space-x-2 rtl:space-x-reverse">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                       href="{{ url(Str::before(request()->path(), $items[$index+1])) }}">{{ $itemName }}</a>
                    <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rtl:transform rtl:rotate-180" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
            @else
                <li>{{ $itemName }}</li>
            @endunless
        @endforeach

    </ul>
    <div class="flex justify-end items-center">
        {{ $slot }}
    </div>
</div>
