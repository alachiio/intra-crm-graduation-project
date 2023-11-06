<div {{ $attributes->merge(['class' => 'relative w-full']) }}>
    <div x-on:refresh-datatable.window="handleRefresh($event)"> <!-- :class="{'opacity-50': loading}" -->
        <div class="mb-4">
            <div class="flex items-center space-x-2 mx-5">
                <div class="flex items-center space-x-2 grow">
                    <span>{{__('Display')}}</span>
                    <select x-model="config.pageLength" class="w-20 border-slate-200 dark:border-slate-600 rounded bg-slate-50 dark:bg-transparent focus:ring-0 py-1 px-2">
                        <template x-for="item in config.lengthMenu">
                            <option x-html="item.text" x-bind:value="item.value"></option>
                        </template>
                    </select>
                    <span>{{ __('Entries') }}</span>
                </div>
                <x-datatables.partials.loading x-show="loading"></x-datatables.partials.loading>
                <div class="flex-none">
                    <input type="text"
                           class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                           placeholder="Type a Keyword.." x-model.lazy="config.search"/>
                </div>
            </div>
        </div>
        <div>
            <table class="w-full" x-ref="table">
                <thead class="dt_table_columns_header">
                <tr class="bg-slate-200 dark:bg-slate-800 text-gray-600 dark:text-gray-200">
                    {{--                    <th class="p-3 w-10">--}}
                    {{--                        <input type="checkbox"--}}
                    {{--                               class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"--}}
                    {{--                               x-effect="selectAllEffect($el)"--}}
                    {{--                               @change="selectAll()"/>--}}
                    {{--                    </th>--}}
                    <template x-for="column in config.columns">
                        <th @click="sort(column)" x-show="!column.hidden" class="p-3">
                            <div class="flex items-center cursor-pointer leading-4">
                                <span x-text="column.title"></span>
                                <template x-if="config.orderBy.column === column.name">
                                    <x-datatables.partials.sort x-bind:dir="config.orderBy.dir"></x-datatables.partials.sort>
                                </template>
                            </div>
                        </th>
                    </template>
                    @isset($columns)
                        {{ $columns }}
                    @endisset
                    @isset($actions)
                        <th class="p-3">
                            {{ __('Actions') }}
                        </th>
                    @endisset
                </tr>
                </thead>
                <tbody>
                <template x-if="config.query.data?.length === 0">
                    <tr>
                        <td :colspan="config.columns.length + 2" class="text-center pt-4">
                            {{ __('No data to show') }}
                        </td>
                    </tr>
                </template>
                <template x-for="row in config.query.data">
                    <tr class="hover:bg-slate-100 dark:hover:bg-slate-600 border-b border-b-slate-200 dark:border-b-slate-600"
                        :class="[selected.indexOf(row.id) > -1 ? `bg-slate-100 dark:bg-slate-700`:'bg-transparent',`row-${row.id}`]" :key="`row-${row.id}`">
                        {{--                        <td class="p-4 w-10 text-center">--}}
                        {{--                            <input type="checkbox"--}}
                        {{--                                   class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"--}}
                        {{--                                   :value="row.id"--}}
                        {{--                                   x-model.number="selected"/>--}}
                        {{--                        </td>--}}
                        <template x-for="column in config.columns">
                            <td class="p-4" x-data="{editable: column.hasOwnProperty('editable')}" x-show="!column.hidden">
                                <template x-if="editable">
                                    <x-datatables.partials.editable x-data="{column: column, row: row}"></x-datatables.partials.editable>
                                </template>
                                <template x-if="!editable" x-data="{value: helpers.getJsonValue(row, column.data.replace('->', '.'))}">
                                    <span x-html="column.hasOwnProperty('html') ? column.html.replace('{val}', value.toLowerCase()) : value"></span>
                                </template>
                            </td>
                        </template>
                        {{ $slot }}
                        @isset($actions)
                            <th class="p-4">
                                {{ $actions }}
                            </th>
                        @endisset
                    </tr>
                </template>
                </tbody>
                @isset($form)
                    <tfoot>
                    {{ $form }}
                    </tfoot>
                @endisset
            </table>
        </div>
        <template x-if="config.query.data?.length">
            <div class="flex items-center mt-4 mx-5">
                <div class="grow flex items-center space-x-2">
                    <p x-html="`{{ __('Results') }} ${config.query.from} - ${config.query.to} {{ __('of') }} ${config.query.total}`"></p>
                    <span x-text="`${selected.length} {{__('Selected')}}`" :class="{'text-primary' : selected.length}"></span>
                </div>
                <template x-if="config.query.links.length > 3">
                    <div class="flex-none flex items-center space-x-2">
                        <template x-for="link in config.query.links">
                            <button type="button" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer"
                                    :class="[!link.url ? 'opacity-50' : '', link.active ? 'bg-primary text-white' : `bg-slate-100 dark:bg-slate-600`]"
                                    @click="paginate(link.url)" x-bind:disabled="!link.url || parseInt(link.label) === config.page">
                                <x-datatables.partials.pagination x-data="{label: link.label}"></x-datatables.partials.pagination>
                            </button>
                        </template>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
