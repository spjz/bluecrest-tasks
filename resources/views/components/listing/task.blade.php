<div id="task-{{ $task->id }}" data-task-id="{{ $task->id }}" {{ $attributes->merge(['class' => 'px-4 py-2 bg-gray-900 border border-transparent rounded-md text-white hover:bg-gray-800 active:bg-gray-700 focus:outline-none transition ease-in-out duration-150']) }}>
    <div>
        <div clas="border border-white">
            <span>{{ $task->title }}</span>
            <p>{{ $task->description }}</p>
        </div>
        <div>
            <span class="block">Due: {{ $task->due_date }}</span>
        </div>
        <div>
            <span>Status: {{ $task->status }}</span>
        </div>

        <div class="text-sm text-uppercase sm:ms-6">
            <a href="/api/tasks/{{ $task->id }}" class="button delete-task">{{ __('Delete') }}</a>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const taskElement = document.getElementById('task-{{ $task->id }}');
            const deleteTaskButton = taskElement.querySelector('.delete-task');

            deleteTaskButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                window.axios.delete(e.currentTarget.href).then(
                    (data) => {
                        if (data.status === 204) {
                            location.reload();
                        }
                        console.log(data);
                    }
                );
            })
        });
    </script>
</div>