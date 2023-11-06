<div x-show="$store.global.isRightSidebarExpanded" @keydown.window.escape="$store.global.isRightSidebarExpanded = false">
    <div class="fixed inset-0 z-[150] bg-slate-900/60 transition-opacity duration-200"
        @click="$store.global.isRightSidebarExpanded = false" x-show="$store.global.isRightSidebarExpanded"
        x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
    <div class="fixed right-0 top-0 z-[151] h-full w-full sm:w-80">
        <div x-data="{ activeTab: 'tabHome' }"
            class="relative flex h-full w-full transform-gpu flex-col bg-white transition-transform duration-200 dark:bg-navy-750"
            x-show="$store.global.isRightSidebarExpanded" x-transition:enter="ease-out"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="ease-in" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">
            <div class="flex items-center justify-between py-2 px-4">
                <p class="flex shrink-0 items-center space-x-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xs">25 May, 2022</span>
                </p>
                <button @click="$store.global.isRightSidebarExpanded=false"
                    class="btn -mr-1 h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
