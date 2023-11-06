<label class="mt-1.5 flex -space-x-px"
       x-data="usePopper({ placement: 'bottom-start', offset: 1 }, { countries: {{ json_encode($countries) }} , current: 0 })"
       @click.outside="if(isShowPopper) isShowPopper = false">
    <span
        class="flex items-center space-x-2 justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450" @click="isShowPopper =
          !isShowPopper"
        x-ref="popperRef">
        <span :class="`fi-${countries[current].flag}`" class="fi text-lg"></span>
        <strong x-text="`(+${countries[current].code})`"></strong>
        <input type="hidden" name="{{  $name.'_country_code' }}" x-model="countries[current].code">
    </span>
    <div :class="isShowPopper && 'show'" class="popper-root" x-ref="popperRoot">
        <div
            class="popper-box mx-4 mt-1 flex max-h-[calc(100vh-6rem)] flex-col rounded-lg bg-slate-150 shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark sm:m-0 sm:w-80">
            <div class="tab-content flex flex-col overflow-hidden">
                <div class="is-scrollbar-hidden overflow-y-auto px-4 py-4">
                    <template x-for="(country, index) in countries" :key="index">
                        <span href="javascript:void(0)" class="flex items-center space-x-3 cursor-pointer" :class="index > 0 && 'mt-4'" @click.prevent="current = index; isShowPopper = false">
                            <div class="flex items-center space-x-2">
                                <span :class="`fi-${country.flag}`" class="fi text-lg"></span>
                                <strong x-text="`(+${country.code})`"></strong>
                            </div>
                            <div>
                                <p class="font-medium text-slate-600 dark:text-navy-100" x-text="country.original_name"></p>
                            </div>
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <input
        x-mask="999999999"
        class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
        placeholder="{{ $placeholder }}"
        type="text" name="{{ $name }}" value="{{ old($name) }}"
    />
</label>
