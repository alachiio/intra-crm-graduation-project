<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
    <div class="col-span-12 lg:col-span-4">
        <div class="card p-4 sm:p-5">
            <div class="flex items-center space-x-4">
                <x-layouts.avatar class="h-14 w-14"></x-layouts.avatar>
                <div>
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        {{ $user->name }}
                    </h3>
                </div>
                <x-spinners.circle class="grow flex justify-end w-8 h-8" target="changeTab"></x-spinners.circle>
            </div>
            <ul class="mt-6 space-y-1.5 font-inter font-medium">
                @foreach($tabs as $key => $tab)
                    <li>
                        @unless($key == 'delete')
                            <button type="button" wire:click="changeTab('{{ $key }}')"
                                    class="flex w-full items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all @if($key == $current) bg-primary text-white dark:bg-accent
                                @else
                                group hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100 @endif">
                                <i class="fa-solid fa-{{ $tab['icon'] }}"></i>
                                <span>{{ $tab['text'] }}</span>
                            </button>
                        @else
                            <button type="button" wire:click="changeTab('{{ $key }}')"
                                    class="flex w-full items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all @if($key == $current) bg-error text-white
                                    dark:bg-error-focus
                                @else
                                group hover:bg-slate-100 hover:text-red-500 focus:bg-slate-100 focus:text-red-500 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600
                                dark:focus:text-navy-100 @endif">
                                <i class="fa-solid fa-{{ $tab['icon'] }}"></i>
                                <span>{{ $tab['text'] }}</span>
                            </button>
                        @endunless
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-8">
        <div class="card">
            @if($current == 'general')
                <livewire:profile.general-form/>
            @endif
            @if($current == 'password')
                <livewire:profile.password-form/>
            @endif
        </div>
    </div>
</div>
