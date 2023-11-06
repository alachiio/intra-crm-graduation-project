<x-app-layout title="Register">
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
            <a href="#" class="flex items-center space-x-2">
                <img class="h-12 w-12 " src="{{ asset('images/app-logo.svg') }}" alt="logo"/>
                <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
                    {{ config('app.name') }}
                </p>
            </a>
        </div>
        <div class="w-full">
            <div class="text-center">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode"
                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg x-show="darkMode"
                         class="h-6 w-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11.75 3.412a.818.818 0 01-.07.917 6.332 6.332 0 00-1.4 3.971c0 3.564 2.98 6.494 6.706 6.494a6.86 6.86 0 002.856-.617.818.818 0 011.1 1.047C19.593 18.614 16.218 21 12.283 21 7.18 21 3 16.973 3 11.956c0-4.563 3.46-8.31 7.925-8.948a.818.818 0 01.826.404z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" x-show="!darkMode"
                         class="h-6 w-6 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                              clip-rule="evenodd"/>
                    </svg>
                </button> <!-- Monochrome Mode Toggle -->
            </div>
            <div class="text-center">
                <img class="mx-auto h-16 w-16 lg:hidden " src="{{ asset('images/app-logo.svg') }}" alt="logo"/>
                <div class="mt-4">
                    <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100 capitalize">
                        {{ __('Welcome To', ['name' =>  config('app.name')]) }}
                    </h2>
                    <p class="text-slate-400 dark:text-navy-300 capitalize">
                        {{ __('Please sign up to continue') }}
                    </p>
                </div>
            </div>
            <livewire:auth.register-form/>
            <div class="mt-4 text-center text-xs+">
                <p class="line-clamp-1">
                    <span> {{ __('Already have an account?') }} </span>
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                       href="{{ route('login') }}">{{ __('Sign In') }}</a>
                </p>
            </div>
        </div>
    </main>
</x-app-layout>
