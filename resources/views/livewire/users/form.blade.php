<x-forms.form-wizard :title="$title" :current="$current" :steps="$steps" :tabs="$tabs">
    <!-- Basic Information -->
    <div x-show.transition.in="current === 1" class="step-1">
        <div class="flex sm:flex-row flex-col sm:space-y-0 space-y-5 justify-center items-center">
            <x-inputs.avatar name="profile_photo_path" label="{{ __('Profile Photo') }}"
                             :image="$this->files['profile_photo_path']"
                             class="flex flex-1 justify-center"></x-inputs.avatar>
            <div class="flex flex-col space-y-4 items-center grow">
                <h3 class="font-semibold text-lg">{{ __('Account Status') }}</h3>
                <div class="flex justify-center items-center space-x-3">
                    @foreach($params['account_statuses'] as $value => $name)
                        <x-inputs.radio name="account_status"
                                        label="{{ $name }}"
                                        class="{{ App\Enums\AccountStatusEnum::css_class($value) }}"
                                        value="{{ $value }}"></x-inputs.radio>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col mt-6">

            <div class="grid lg:grid-cols-2 grid-cols-1 gap-x-3">
                <x-inputs.input name="f_name" type="text"
                                label="{{ __('First Name') }}"
                                :placeholder="false"
                                validate="true"></x-inputs.input>
                <x-inputs.input name="l_name" type="text"
                                label="{{ __('Last Name') }}"
                                :placeholder="false"
                                validate="true"></x-inputs.input>
            </div>
            <x-inputs.input name="email" type="email"
                            label="{{ __('Email') }}"
                            :placeholder="false"
                            validate="true"></x-inputs.input>
            <div x-data="{updatePassword: @entangle('updatePassword')}" @if($editing and !$updatePassword) x-tooltip.placement.top="`{{ __('Leave blank for same value') }}`" @endif
            class="flex space-x-3">
                <x-inputs.input class="flex-1" name="password" type="password"
                                label="{{ __('Password') }}"
                                :placeholder="false"
                                validate="true" x-bind:disabled="!updatePassword">
                </x-inputs.input>
                <x-inputs.input class="flex-1" name="password_confirmation" type="password"
                                label="{{ __('Repeat Password') }}"
                                :placeholder="false"
                                x-bind:disabled="!updatePassword"
                                validate="true"></x-inputs.input>
                @if($editing)
                    <div>
                        <button type="button" class="btn active:bg-primary-focus text-white text-sm cursor-pointer px-2 mt-1" wire:click="toggleUpdatePassword()"

                                x-bind:class="updatePassword ? 'bg-red-500' : 'bg-primary'">
                            <i class="fa-regular fa-pen-to-square" x-show="!updatePassword"></i>
                            <i class="fa-regular fa-circle-xmark" x-show="updatePassword"></i>
                        </button>
                    </div>
                @endif
            </div>

            <x-inputs.input name="phone" type="tel"
                            label="{{ __('Phone') }}"
                            :placeholder="false"
                            x-mask="999999999"></x-inputs.input>

            <x-inputs.datepicker name="dob"
                                 label="{{ __('Date Of Birth') }}"
                                 :placeholder="false"
                                 validate="true"></x-inputs.datepicker>
            @if(auth()->user()->hasAnyRole(['super', 'admin']))
                <x-inputs.select name="current_team_id"
                                 :placeholder="false"
                                 label="{{ __('Current Team') }}"
                                 validate="true"
                                 :options="$params['teams']"></x-inputs.select>
                <x-inputs.select name="role"
                                 prefix=""
                                 :placeholder="false"
                                 label="{{ __('Role') }}"
                                 validate="true"
                                 :options="$params['roles']"></x-inputs.select>
            @endif
        </div>
    </div>
    <div x-show.transition.in="current === 2" class="step-2">
        <h2>Role: {{ ($role) ? __('roles.'.App\Enums\RoleEnum::from($role)->name) : '' }}</h2>
        <x-templates.table-permissions/>
    </div>
    <x-slot:submit>
        @if($current == count($tabs))
            <x-buttons.button-loading class="w-36 h-10" type="submit">
                {{ __('Submit')}}
            </x-buttons.button-loading>
        @endif
    </x-slot:submit>
</x-forms.form-wizard>
