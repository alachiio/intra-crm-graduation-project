@props(['dir' => 'ASC'])
<p class="ltr:ml-auto rtl:mr-auto">
    <svg xmlns="http://www.w3.org/2000/svg"
         class="sort-arrow h-4 w-4"
         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        @if($dir == 'ASC')
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7 11l5-5m0 0l5 5m-5-5v12"/>
        @else
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
        @endif
    </svg>
</p>
