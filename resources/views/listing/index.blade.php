<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">

                    @if (!count($tasks))
                    <span class="text-red-600">No tasks found</span>
                    @endif

                    <div class="flex gap-4">
                        @foreach ($tasks as $task)
                        <x-listing.task :task="$task" />
                        @endforeach
                    </div>

                    <div class="py-6">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('listing.partials.create-task-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>