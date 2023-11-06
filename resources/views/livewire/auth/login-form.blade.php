<x-forms.form title="hidden" type="livewire">
    <label class="relative flex">
        <x-inputs.input type="email" name="email" label="{{ __('Email Address') }}" placeholder="true" validate="true" class="mb-0 w-full" input-class="peer ltr:pl-9 rtl:pr-9" required
                        autofocus>
                    <span
                        class="pointer-events-none absolute flex h-10 w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
        </x-inputs.input>
    </label>
    <label class="relative flex">
        <x-inputs.input type="password" name="password" label="{{ __('Password') }}" placeholder="true" validate="true" class="mb-0 w-full" input-class="peer ltr:pl-9 rtl:pr-9" required>
                    <span
                        class="pointer-events-none absolute flex h-10 w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
        </x-inputs.input>
    </label>
    <div class="mt-4 flex items-center justify-between space-x-2">
        <x-inputs.switch-checkbox name="remember" label="{{ __('Remember me') }}" class="!mb-0"/>
        <a href="{{ route('password.request') }}"
           class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100
                       dark:focus:text-navy-100">{{ __('Forgot Password?') }}</a>
    </div>
    <x-buttons.button-loading class="mt-10 w-full h-10" type="submit">
        {{ __('Sign In') }}
    </x-buttons.button-loading>
</x-forms.form>
