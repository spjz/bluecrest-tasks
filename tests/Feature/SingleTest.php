<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class SingleTest extends TestCase
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
}
