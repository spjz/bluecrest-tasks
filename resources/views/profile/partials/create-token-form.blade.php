<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Personal Access Token') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create a new API personal access token.') }}
        </p>
    </header>

    <form method="post" action="{{ route('token.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>

            @if (session('status') === 'token-created')
            <p x-data="{ show: true }" x-show="show" x-transition class="text-sm text-gray-600 dark:text-gray-400">{{ session('token') }}</p>
            @endif
        </div>
    </form>
</section>