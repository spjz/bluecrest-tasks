<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_Index_Returns_Data_In_Valid_Format(): void
    {
        $this->json('get', '/api/tasks')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'due_date',
                            'status',
                            'user_id',
                        ]
                    ]
                ]
            );
    }

    public function test_task_is_created_successfully(): void
    {
        $payload = [
            'title' => $this->faker->title,
            'description'  => $this->faker->description,
            'due_date'      => $this->faker->due_date,
            'status'      => $this->faker->status,
            'user_id' => $this->user->id,
        ];

        $this->json('post', '/api/tasks', $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'title',
                        'description',
                        'due_date',
                        'status',
                        'user_id',
                    ]
                ]
            );
    }

    public function test_Task_Is_Shown_Correctly()
    {
        $task = $this->user->tasks()->create(
            [
                'title' => $this->faker->title,
                'description'  => $this->faker->description,
                'due_date'      => $this->faker->due_date,
                'status'      => $this->faker->status,
                'user_id' => $this->user->id,
            ]
        );

        $this->json('get', "/api/tasks/$task->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id' => $task->id,
                        'title' => $task->title,
                        'description' => $task->description,
                        'due_date' => $task->due_date,
                        'status' => $task->status,
                        'user_id' => $task->user_id,
                    ]
                ]
            );
    }

    public function test_Task_Is_Destroyed()
    {
        $taskData =
            [
                'title' => $this->faker->title,
                'description'  => $this->faker->description,
                'due_date'      => $this->faker->due_date,
                'status'      => $this->faker->status,
                'user_id' => $this->user->id,
            ];

        $task = $this->user->tasks()->create(
            $taskData
        );

        $this->json('delete', "/api/tasks/$task->id")
            ->assertNoContent()
            ->assertDatabaseMissing('tasks', $taskData);
    }

    public function test_Update_Task_Returns_Correct_Data()
    {
        $payload = [
            'title' => $this->faker->title,
            'description'  => $this->faker->description,
            'due_date'      => $this->faker->due_date,
            'status'      => $this->faker->status,
            'user_id' => $this->user->id,
        ];
        $task = $this->user->tasks()->create($payload);

        $this->json('put', "/api/tasks/$task->id", $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id'    => $task->id,
                        'title' => $payload['title'],
                        'description' => $payload['description'],
                        'due_date' => $payload['due_date'],
                        'status' => $payload['status'],
                        'user_id' => $payload['user_id'],
                    ]
                ]
            );
    }

    public function test_Show_For_Missing_Task()
    {
        $this->json('get', "api/tasks/0")
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message']);
    }

    public function test_Update_For_Missing_Task()
    {
        $payload = [
            'title' => $this->faker->title,
            'description'  => $this->faker->description,
            'due_date'      => $this->faker->due_date,
            'status'      => $this->faker->status,
        ];

        $this->json('put', '/api/tasks/0', $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message']);
    }

    public function test_Destroy_For_Missing_Task()
    {
        $this->json('delete', '/api/tasks/0')
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message']);
    }

    public function test_Store_With_Missing_Data()
    {
        $payload = [
            // 'title' => $this->faker->sentence,
            'description'  => $this->faker->description,
            'due_date' => $this->faker->due_date,
            'status' => $this->faker->status,
            'user_id' => $this->user->id,

        ];
        $this->json('post', '/api/tasks', $payload)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJsonStructure(['message']);
    }
}
