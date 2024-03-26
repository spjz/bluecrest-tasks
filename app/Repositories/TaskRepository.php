<?php

namespace App\Repositories;

use App\Models\Task;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\User;

class TaskRepository implements TaskRepositoryInterface
{
    public function index()
    {
        return Task::all();
    }

    public function forUser(User $user)
    {
        return Task::whereUserId($user->id);
    }

    public function paginate($items)
    {
        return Task::paginate($items);
    }

    public function getById($id)
    {
        return Task::findOrFail($id);
    }

    public function store(User $user, array $data)
    {
        return $user->tasks()
            ->create($data);
    }

    public function update(array $data, $id)
    {
        $task = Task::findOrFail($id);

        return $task->update($data);
    }

    public function delete($id)
    {

        // $user->tasks()->destroy($id);
        return Task::destroy($id);
    }
}
