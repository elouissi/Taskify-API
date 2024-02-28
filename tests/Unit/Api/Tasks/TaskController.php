<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskController extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_returns_all_tasks()
    {
        Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->json('GET', '/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    /** @test */
/** @test */
public function it_creates_a_new_task()
{
    $taskData = [
        'name' => 'New Task',
        'status' => 'done',
    ];

    $response = $this->actingAs($this->user)->json('POST', '/api/tasks', $taskData);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'New Task']);
}


    /** @test */
    public function it_updates_a_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $updatedData = ['name' => 'UpdatedTask'];

        $response = $this->actingAs($this->user)->json('PUT', "/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Task']);
    }

    /** @test */
    public function it_deletes_a_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->json('DELETE', "/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
