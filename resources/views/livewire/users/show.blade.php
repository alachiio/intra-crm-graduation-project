<div class="card">
    <div class="tabs flex flex-col">
        <div class="is-scrollbar-hidden overflow-x-auto">
            <div class="flex items-center border-b-2 border-slate-150 dark:border-navy-500">
                <div class="tabs-list -mb-0.5 flex">
                    @foreach($tabs as $key => $tab)
                        <button type="button" wire:click="changeTab('{{ $key }}')"
                                class="btn h-14 shrink-0 space-x-2 rounded-none border-b-2 px-4 sm:px-5 font-medium @if($key == $current) border-primary text-primary dark:border-accent
                            dark:text-accent-light @else border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100 @endif">
                            <i class="fa-solid fa-{{ $tab['icon'] }} text-base"></i>
                            <span>{{ $tab['text'] }}</span>
                        </button>
                    @endforeach
                </div>
                <x-spinners.circle class="ltr:ml-5 rtl:mr-5 w-4 h-4" target="changeTab"></x-spinners.circle>
            </div>
        </div>
        <div class="tab-content p-4 sm:p-5">

            <div class="space-y-5">
                @if($current == 'general')
                    <div class="flex justify-center mb-8">
                        <x-layouts.avatar :user="$row" class="w-32 h-32"></x-layouts.avatar>
                    </div>
                    <div class="flex lg:flex-row flex-col lg:space-y-0 space-y-4">
                        <div class="grid grid-cols-2 gap-4 flex-1">
                            <div class="font-semibold">{{ __('First Name') }}</div>
                            <div>{{ $row->f_name }}</div>
                            <div class="font-semibold">{{ __('Last Name') }}</div>
                            <div>{{ $row->l_name }}</div>
                            <div class="font-semibold">{{ __('Email') }}</div>
                            <div>{{ $row->email }}</div>
                            <div class="font-semibold">{{ __('Date Of Birth') }}</div>
                            <div>{{ $row->dob }}</div>
                            <div class="font-semibold">{{ __('Phone') }}</div>
                            <div>{{ $row->phone }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 flex-1">
                            <div class="font-semibold">{{ __('Account Status') }}</div>
                            <div class="capitalize">{!! $row->status !!}</div>
                            <div class="font-semibold">{{ __('City') }}</div>
                            <div>{{ ($row->city) ? $row->city->getTranslation('name', locale()) : '' }}</div>
                            <div class="font-semibold">{{ __('Address') }}</div>
                            <div>{{ $row->address }}</div>
                        </div>
                    </div>
                @endif
                @if($current == 'wallets')
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                        @foreach($row->wallets as $wallet)
                            <x-templates.wallet-card :row="$wallet">
                                <x-dropdowns.actions :options="[
                                    'show' => ['user' => $row->user_id, 'wallet' => $wallet->wallet_no],
                                    'edit' => ['user' => $row->user_id, 'wallet' => $wallet->wallet_no],
                                    'destroy' => ['user' => $row->user_id, 'wallet' => $wallet->wallet_no],
                                ]" :route="'users.wallets'"></x-dropdowns.actions>
                            </x-templates.wallet-card>
                        @endforeach
                    </div>
                @endif
                @if($current == 'documents')
                    @foreach($row->documents->groupBy('verificationType.name') as $type => $items)
                        <h1 class="capitalize font-bold text-xl text-primary dark:text-accent">{{ $type }}</h1>
                        <div class="ltr:ml-4 rtl:mr-4">
                            @foreach($items as $item)
                                <div class="grid grid-cols-2 gap-4 lg:w-1/2">
                                    <div class="font-semibold">{{ __('Document Type') }}</div>
                                    <div class="capitalize">{{ $item->documentType->getTranslation('name', locale()) }}</div>
                                    <div class="font-semibold">{{ __('Status') }}</div>
                                    <div>{!! App\Enums\UserDocumentStatusEnum::html($item->status, true) !!}</div>
                                    <div class="font-semibold">{{ __('Document') }}</div>
                                    <div class="flex items-center space-x-6">
                                        @foreach($item->document_path as $key => $path)
                                            <a target="_blank" href="{{ asset($path) }}"><i class="fa-solid fa-file"></i>
                                                {{ $key+1 }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
                @if($current == 'security_questions')
                    <div class="grid grid-cols-2 gap-4 flex-1">
                        @foreach($row->securityQuestions as $user_question)
                            <div class="font-semibold">{{ $user_question->question->getTranslation('name', 'en')}}</div>
                            <div>{{ $user_question->user_answer }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <x-buttons.float-button type="link" href="{{ route('users.edit', $row->user_id) }}" x-tooltip.placement.top="`{{ __('Edit', ['name' => __('User')]) }}`">
            <i class="fa-solid fa-pencil text-xl"></i>
        </x-buttons.float-button>
    </div>
</div>
