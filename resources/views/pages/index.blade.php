<x-app-layout :title="__('Dashboard')" :has-side-panel="false">
    <!-- Main Content Wrapper -->
    <div
        class="mt-4 grid grid-cols-1 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
    >
        <div
            class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4 lg:gap-6"
        >
            <div class="card flex-row justify-between p-4">
                <div>
                    <p class="text-xs+ uppercase">Contacts</p>
                    <div class="mt-8 flex items-baseline space-x-1">
                        <p
                            class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                            {{ App\Models\Contact::count() }}
                        </p>
                        <p class="text-xs text-success">+21%</p>
                    </div>
                </div>
                <div
                    class="mask is-squircle flex h-10 w-10 items-center justify-center bg-warning/10"
                >
                    <i class="fa-solid fa-user text-xl text-warning"></i>
                </div>
                <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
                    <i
                        class="fa-solid fa-user translate-x-1/4 translate-y-1/4 text-5xl opacity-15"
                    ></i>
                </div>
            </div>
            <div class="card flex-row justify-between p-4">
                <div>
                    <p class="text-xs+ uppercase">Leads</p>
                    <div class="mt-8 flex items-baseline space-x-1">
                        <p
                            class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                            {{ App\Models\Lead::count() }}
                        </p>
                        <p class="text-xs text-success">+4%</p>
                    </div>
                </div>
                <div
                    class="mask is-squircle flex h-10 w-10 items-center justify-center bg-info/10"
                >
                    <i class="fa-solid fa-funnel-dollar text-xl text-info"></i>
                </div>
                <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
                    <i
                        class="fa-solid fa-funnel-dollar translate-x-1/4 translate-y-1/4 text-5xl opacity-15"
                    ></i>
                </div>
            </div>
            <div class="card flex-row justify-between p-4">
                <div>
                    <p class="text-xs+ uppercase">Active Campaigns</p>
                    <div class="mt-8 flex items-baseline space-x-1">
                        <p
                            class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                            {{ App\Models\Campaign::where('is_active', App\Enums\BooleanEnum::YES->value)->count() }}
                        </p>
                        <p class="text-xs text-success">+8%</p>
                    </div>
                </div>
                <div
                    class="mask is-squircle flex h-10 w-10 items-center justify-center bg-success/10"
                >
                    <i class="fa-solid fa-bullhorn text-xl text-success"></i>
                </div>
                <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
                    <i
                        class="fa-solid fa-bullhorn translate-x-1/4 translate-y-1/4 text-5xl opacity-15"
                    ></i>
                </div>
            </div>
            <div class="card flex-row justify-between p-4">
                <div>
                    <p class="text-xs+ uppercase">Payments</p>
                    <div class="mt-8 flex items-baseline space-x-1">
                        <p
                            class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                            {{ App\Models\Payment::count() }}
                        </p>
                        <p class="text-xs text-error">-2.3%</p>
                    </div>
                </div>
                <div
                    class="mask is-squircle flex h-10 w-10 items-center justify-center bg-error/10"
                >
                    <i class="fa-solid fa-circle-dollar-to-slot text-xl text-error"></i>
                </div>
                <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
                    <i
                        class="fa-solid fa-circle-dollar-to-slot translate-x-1/4 translate-y-1/4 text-5xl opacity-15"
                    ></i>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-2 lg:gap-6">
            <div>
                <div class="flex h-8 items-center justify-between">
                    <h2
                        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                    >
                        Activity
                    </h2>

                    <select
                        class="form-select h-8 rounded-full border border-slate-300 bg-slate-50 px-2.5 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-600 dark:bg-navy-900 dark:hover:border-navy-400 dark:focus:border-accent"
                    >
                        <option>05 - 12 May</option>
                        <option>12 - 19 May</option>
                        <option>19 - 26 May</option>
                        <option>26 - 02 June</option>
                        <option>02 - 09 June</option>
                    </select>
                </div>

                <div>
                    <div
                        x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.influencerActivity); $el._x_chart.render() });"
                    ></div>
                </div>
            </div>
            <div>
                <div class="flex h-8 items-center justify-between">
                    <h2
                        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                    >
                        Recent Lead Notes
                    </h2>
                </div>

                <table class="w-full">
                    <tbody>
                    @foreach(App\Models\LeadNote::orderBy('created_at', 'DESC')->limit(5)->get() as $note)
                        <tr>
                            <td class="whitespace-nowrap pt-4">
                                <h3
                                    class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    On : {{ $note->lead->name }}
                                </h3>
                            </td>
                            <td class="whitespace-nowrap pt-4">
                                <h3
                                    class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    By : {{ $note->user->name }}
                                </h3>
                            </td>
                            <td class="whitespace-nowrap pt-4">
                                <h3
                                    class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    {{ $note->note }}
                                </h3>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <div class="flex h-8 items-center justify-between">
                <h2
                    class="font-bold text-lg tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                >
                    Recent Leads
                </h2>
                @can('leads.view')
                    <a
                        href="{{ route('leads.index') }}"
                        class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70"
                    >
                        View All
                    </a>
                @endcan
            </div>

            <table class="w-full mt-3">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                </tr>
                </thead>
                <tbody>
                @foreach(App\Models\Lead::orderBy('created_at', 'DESC')->limit(5)->get() as $lead)
                    <tr>
                        <td class="whitespace-nowrap pt-4">
                            <h3
                                class="font-medium line-clamp-1"
                            >
                                {!!  $lead->lead_status !!}
                            </h3>
                        </td>
                        <td class="whitespace-nowrap pt-4">
                            <h3
                                class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                            >
                                {{ $lead->name }}
                            </h3>
                        </td>
                        <td class="whitespace-nowrap pt-4">
                            <h3
                                class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                            >
                                {{ $lead->email }}
                            </h3>
                        </td>
                        <td class="whitespace-nowrap pt-4">
                            <h3
                                class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                            >
                                {{ $lead->phone }}
                            </h3>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
