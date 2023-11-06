@props(['title', 'current', 'steps', 'tabs'])

<div x-data="{
                steps : @entangle('steps'),
                current : @entangle('current')
    }" x-cloak {{ $attributes }}>
    <x-forms.form type="livewire">
        @if(isset($tabs) and $tabs)
            <x-slot:tabs>
                <div
                    x-data="{isStuck:false}"
                    class="pb-6"
                    {{--                    x-intersect:enter.full.margin.-60px.0.0.0="isStuck = false"--}}
                    {{--                    x-intersect:leave.full.margin.-60px.0.0.0="isStuck = true"--}}
                >
                    <div :class="isStuck && 'fixed right-0 top-0 w-full z-10'">
                        <div
                            class="transition-all duration-200"
                            :class="isStuck && 'py-2.5 px-4 bg-white dark:bg-navy-700 shadow-lg relative'"
                        >
                            <ol class="steps with-space-line">
                                @foreach($tabs as $index => $tab)
                                    <li
                                        class="form-wizard-step step"
                                        :class="current > {{ $index + 1 }} ? 'before:bg-primary dark:before:bg-accent' : 'before:bg-slate-200 dark:before:bg-navy-500'">
                                        <div
                                            class="step-header rounded-full"
                                            :class="current >= {{$index + 1}} ? 'bg-primary text-white dark:bg-accent' : 'bg-slate-200 text-slate-800 dark:bg-navy-500 dark:text-white'"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                x-show="current > {{ $index + 1 }}"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            <span x-show="current <= {{ $index + 1 }}"> {{ $index + 1 }} </span>
                                        </div>
                                        <h3
                                            class="capitalize text-xs font-medium text-slate-700 dark:text-navy-100"
                                        >
                                            {{ $tab }}
                                        </h3>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </x-slot:tabs>
        @endif
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12"> <!-- sm:col-span-8 -->
                <div class="card p-4 sm:p-5 relative">
                    @if($title !== 'hidden')
                        <p class="capitalize mb-4 text-base text-lg font-medium text-slate-700 dark:text-navy-100">
                            {{ $title }}
                        </p>
                    @endif
                    <div x-transition.duration.500ms>
                        {{ $slot }}
                    </div>
                    <div class="flex mt-4 justify-center items-center space-x-2">
                        @php
                            $class = 'btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-primary hover:text-white dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450';
                        @endphp
                        <x-spinners.circle class="absolute bottom-3 ltr:right-0 rtl:left-1 w-5 h-5" target="paginate"></x-spinners.circle>
                        @unless($current == 1)
                            <button type="button" class="form-wizard-prev {{ $class }}"
                                    @click="$dispatch('paginate', 'prev')"
                                    :disabled="current == 1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{ __('pagination.previous') }}</span>
                            </button>
                        @endunless
                        @unless($current == count($tabs))
                            <button type="button" class="form-wizard-next {{ $class }}"
                                    @click="$dispatch('paginate', 'next')"
                                    :disabled="current == steps">
                                <span>{{ __('pagination.next') }}</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        @endunless
                        <div>
                            @isset($submit)
                                {{ $submit }}
                            @else
                                <x-buttons.button-loading class="w-36 h-10" type="submit">
                                    {{ __('Submit')}}
                                </x-buttons.button-loading>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            {{--            @if(isset($tabs) and $tabs)--}}
            {{--                <div class="hidden sm:col-span-4 sm:block">--}}
            {{--                    <div class="sticky top-24 mt-3">--}}
            {{--                        <ol class="steps is-vertical line-space">--}}
            {{--                            @foreach($tabs as $index => $tab)--}}
            {{--                                <li--}}
            {{--                                    class="form-wizard-step step pb-8 flex items-center space-x-3"--}}
            {{--                                    :class="current > {{ $index + 1 }} ? 'before:bg-primary dark:before:bg-accent' : 'before:bg-slate-200 dark:before:bg-navy-500'">--}}
            {{--                                    <div--}}
            {{--                                        class="step-header rounded-full"--}}
            {{--                                        :class="current >= {{$index + 1}} ? 'bg-primary text-white dark:bg-accent' : 'bg-slate-200 text-slate-800 dark:bg-navy-500 dark:text-white'"--}}
            {{--                                    >--}}
            {{--                                        <svg--}}
            {{--                                            xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                            class="h-5 w-5"--}}
            {{--                                            viewBox="0 0 20 20"--}}
            {{--                                            fill="currentColor"--}}
            {{--                                            x-show="current > {{ $index + 1 }}"--}}
            {{--                                        >--}}
            {{--                                            <path--}}
            {{--                                                fill-rule="evenodd"--}}
            {{--                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
            {{--                                                clip-rule="evenodd"--}}
            {{--                                            />--}}
            {{--                                        </svg>--}}
            {{--                                        <span x-show="current <= {{ $index + 1 }}">{{ $index + 1 }}</span>--}}
            {{--                                    </div>--}}
            {{--                                    <h3--}}
            {{--                                        class="ltr:ml-4 rtl:mr-4 capitalize text-slate-700 dark:text-navy-100"--}}
            {{--                                    >--}}
            {{--                                        {{ $tab }}--}}
            {{--                                    </h3>--}}
            {{--                                </li>--}}
            {{--                            @endforeach--}}
            {{--                        </ol>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endif--}}
        </div>
    </x-forms.form>
    <template x-teleport="#x-teleport-scripts">
        <script type="text/javascript">
            window.addEventListener('paginate', event => {
                if (event.detail === 'next') {
                    let fields = [];
                    document.querySelectorAll(`.step-${@this.current} .has-validation`).forEach((val) => {
                        fields.push(val.name);
                    });
                    @this.
                    call('paginate', 'next', fields)
                } else {
                    @this.
                    call('paginate', 'prev')
                }
            })
        </script>
    </template>
</div>

<!-- Form Wizard Template ( use it in your component ) -->
{{--<div>--}}
{{--    <x-forms.form-wizard :title="$title" :current="$current" :steps="$steps" :tabs="($editing) ? $tabs : null">--}}
{{--        <!-- Basic Information -->--}}
{{--        <div x-show.transition.in="current === 1" class="step-1">--}}
{{--            --}}
{{--        </div>--}}
{{--    </x-forms.form-wizard>--}}
{{--</div>--}}
