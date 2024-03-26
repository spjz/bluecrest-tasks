<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create Task') }}
        </h2>
    </header>

    <form id="addTaskForm" method="post" action="/api/tasks" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <input type="hidden" name="user_id" value="{{ $user->id }}" />

        <div>
            <x-input-label for="create_task_title" :value="__('Title')" />
            <x-text-input id="create_task_title" name="title" type="text" class="mt-1 block w-full" />
        </div>

        <div>
            <x-input-label for="create_task_description" :value="__('Description')" />
            <x-textarea id="create_task_description" name="description" type="text" class="mt-1 block w-full" />
        </div>

        <div>
            <x-input-label for="create_task_due_date" :value="__('Due Date')" />
            <x-date-input id="create_task_due_date" name="due_date" type="text" class="mt-1 block w-full" />
        </div>

        <div>
            <x-input-label for="create_task_status" :value="__('Status')" />
            <x-select-input :options="[0 => 'Pending', 1 => 'Paused', 2 => 'Processing', 3 => 'Complete']" id="create_task_status" name="status" type="text" class="mt-1 block w-full" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button id="addTaskButton">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        const addTaskForm = document.getElementById('addTaskForm');

        // window.axios.get('/sanctum/csrf-cookie').then(response => {
        //     console.log(response);
        // });

        const titleField = document.getElementById('title');
        const descriptionField = document.getElementById('description');
        const dueDateField = document.getElementById('due_date');
        const statusField = document.getElementById('status');

        const addTaskButton = document.getElementById('addTaskButton');
        addTaskButton.addEventListener('click', e => {
            e.preventDefault();
            e.stopPropagation();

            const formData = new FormData(addTaskForm);
            const formDataObject = {};
            formData.forEach(function(value, key) {
                formDataObject[key] = value;
            });

            window.axios.post("/api/tasks", formDataObject).then(
                (data) => {
                    if (data.success) {
                        location.reload();
                    }
                    console.log(data);
                }
            );
        })
    });
</script>