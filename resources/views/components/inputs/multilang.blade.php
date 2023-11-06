<div x-data="{locale: @js(default_lang()) }" {{ $attributes->merge(['class' => 'multi_lang_fieldset']) }}>
    <fieldset class="border rounded p-3 dark:border-navy-450">
        <legend>
            @foreach(languages() as $lang)
                <button type="button"
                        class="w-10 h-10 me-1 last:me-0 border rounded transition-all ease-in-out dark:border-navy-450"
                        :class="[ locale === '{{$lang['locale']}}' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-slate-700' ]"
                        @click="locale = '{{ $lang['locale'] }}'"
                        :disabled="locale === '{{$lang['locale']}}'">
                    {{ $lang['locale'] }}
                </button>
            @endforeach
        </legend>
        {{ $slot }}
    </fieldset>
</div>
