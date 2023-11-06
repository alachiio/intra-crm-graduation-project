<p {{ $attributes }}>
    <template x-if="isNaN(label)">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rtl:transform rtl:rotate-180 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
            <path x-show="label === 'next'" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            <path x-show="label === 'previous'" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
    </template>
    <template x-if="!isNaN(label)">
        <span x-html="label"></span>
    </template>
</p>
