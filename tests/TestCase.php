<?php

namespace Tests;

use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithDatabase;
    use DatabaseMigrations;
    use WithFaker;

    private User $user;

    public function setUp(): void
    {

        parent::setUp();

        // Sanctum::actingAs(
        //     $this->user,
        //     ['tasks']
        // );

        $this->faker = Task::factory()->make();
        Artisan::call('migrate:refresh');
        $this->user = User::factory()->create();
    }

    public function __get($key)
    {
        if ($key === 'faker') {
            return $this->faker;
        } {
            if ($key === 'user')
                return $this->user;
        }
        throw new Exception('Unknown Key Requested');
    }
}
