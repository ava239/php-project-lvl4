<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Task::factory()->count(3)->create();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $task = Task::inRandomOrder()->first();

        $response = $this->get(route('tasks.index'));

        $response->assertOk()
            ->assertSee($task->name);
    }

    public function testCreate()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $this->actingAs($this->user);

        $status = TaskStatus::inRandomOrder()->first();
        $assignee = User::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status_id' => $status->id,
            'assigned_to_id' => $assignee->id
        ];

        $response = $this->post(route('tasks.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $addedTaskData = array_merge($data, ['created_by_id' => $this->user->id]);

        $this->assertDatabaseHas('tasks', $addedTaskData);
    }

    public function testEdit()
    {
        $this->actingAs($this->user);

        $task = Task::inRandomOrder()->first();

        $response = $this->get(route('tasks.edit', $task));

        $response->assertOk()
            ->assertSee($task->name);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user);

        $task = Task::inRandomOrder()->first();
        $status = TaskStatus::inRandomOrder()->first();
        $assignee = User::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text,
            'status_id' => $status->id,
            'assigned_to_id' => $assignee->id
        ];

        $response = $this->patch(route('tasks.update', $task), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $task->fill($data);
        $updatedTaskData = $task->only('id', 'name', 'description', 'status_id', 'assigned_to_id');

        $this->assertDatabaseHas('tasks', $updatedTaskData);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user);

        $task = Task::factory()
            ->state(['created_by_id' => $this->user->id])
            ->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $taskData = $task->only('id');
        $this->assertDatabaseMissing('tasks', $taskData);
    }

    public function testShow()
    {
        $task = Task::inRandomOrder()->first();

        $response = $this->get(route('tasks.show', $task));

        $response->assertOk()
            ->assertSee($task->name);
    }

    public function testUnathorizedDestroy()
    {
        $this->actingAs($this->user);

        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertForbidden();

        $taskData = $task->only('id');
        $this->assertDatabaseHas('tasks', $taskData);
    }
}
