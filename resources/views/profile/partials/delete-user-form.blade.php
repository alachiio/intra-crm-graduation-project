<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Close Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {!! __('Once your account is closed') !!}, {!! __('remember that we will keep all your data and information, if you want to permanently delete your account you need to
                request a deletion to our customer support') !!} <a href="#" class="font-bold">{{ __('From Here') }}</a>
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('show-modal', 'confirm_account_closing_modal')"
    >{{ __('Close Account') }}</x-danger-button>

    <x-modals.backdrop-shadow name="confirm_account_closing_modal" :teleport="false">
        <livewire:profile.delete-form/>
    </x-modals.backdrop-shadow>
</section>
