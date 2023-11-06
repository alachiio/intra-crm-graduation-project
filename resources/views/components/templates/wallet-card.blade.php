@props(['row'])
<div {{ $attributes->merge(['class' => 'card w-full p-4 hover:bg-navy-400 hover:text-white']) }}>
    <div class="w-full h-32 flex flex-col items-center border-2 border-dashed dark:border-gray-600 rounded-lg relative before:content-[''] before:absolute ltr:before:left-0
                rtl:before:right-0
                before:top-1/2
                before:transform
                before:-translate-y-1/2
                before:w-10
                before:h-5 before:border-2 dark:before:border-gray-600 before:border-dashed ltr:before:border-l-0 rtl:before:border-r-0">
        <div class="flex w-full items-center p-2">
            <div class="flex-1">
                {{ $slot }}
            </div>
            <div class="flex flex-1 justify-end">
                <p class="inline-flex w-6 h-6 items-center justify-center bg-yellow-500 text-white rounded-full">
                    <span class="fa-solid fa-{{ $row->currency->code }}"></span>
                </p>
            </div>
        </div>
        <div class="grow w-full ltr:ml-28 rtl:mr-28">
            <span class="font-semibold text-xl" x-init="$countUp($el, {duration: 2000})">{{ $row->balance }}</span>
        </div>
    </div>
</div>
