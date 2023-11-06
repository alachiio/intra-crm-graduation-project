<x-forms.form :title="''" class="p-4" type="livewire">
    <div class="flex sm:flex-row flex-col sm:space-y-0 space-y-5 justify-center items-center">
        <x-inputs.avatar name="profile_photo_path" label="{{ __('Profile Photo') }}"
                         :image="$this->files['profile_photo_path']"
                         class="flex flex-1 justify-center"></x-inputs.avatar>
    </div>
    <div class="grid md:grid-cols-2 grid-cols-1 gap-x-3 mt-6">
        <div>
            <x-inputs.input name="f_name" type="text"
                            mode="{{ $mode }}"
                            label="{{ __('First Name') }}"
                            :placeholder="false"
                            :value="$editing->f_name" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.input>
            <x-inputs.input name="l_name" type="text"
                            mode="{{ $mode }}"
                            label="{{ __('Last Name') }}"
                            :placeholder="false"
                            :value="$editing->l_name" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.input>
            <x-inputs.input name="email" type="email"
                            mode="{{ $mode }}"
                            label="{{ __('Email') }}"
                            :placeholder="false"
                            :value="$editing->email" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.input>
            <x-inputs.datepicker name="dob"
                                 mode="{{ $mode }}"
                                 label="{{ __('Date Of Birth') }}"
                                 :placeholder="false"
                                 :value="$editing->dob" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.datepicker>
        </div>
        <div>
            <x-inputs.input name="phone" type="tel"
                            x-mask="999999999"
                            mode="{{ $mode }}"
                            label="{{ __('Phone') }}"
                            :placeholder="false"
                            :value="$editing->phone" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.input>
            <x-inputs.input name="" type="textarea" prefix=""
                            mode="{{ $mode }}"
                            rows="4"
                            label="{{ __('Email') }}"
                            :placeholder="false"
                            :value="$editing->address" x-bind:disabled="{{ $mode == 'static' }}"></x-inputs.input>
        </div>
    </div>
    <div class="mt-10 flex justify-center">
        <x-buttons.button-loading class="w-36 h-10" type="submit">
            {{ __('Submit')}}
        </x-buttons.button-loading>
    </div>
</x-forms.form>
