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

    private bool $seed = true;

    public function setupUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function testIndex()
    {
        $task = Task::first();
        $response = $this->get(route('tasks.index'));
        $response->assertOk()
            ->assertSee($task->name);
    }

    public function testCreate()
    {
        $this->setupUser();
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $user = $this->setupUser();
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

        $this->assertDatabaseHas(
            'tasks',
            array_merge(
                $data,
                ['created_by_id' => $user->id]
            )
        );
    }

    public function testEdit()
    {
        $this->setupUser();
        $task = Task::inRandomOrder()->first();
        $response = $this->get(route('tasks.edit', $task));
        $response->assertOk()
            ->assertSee($task->name);
    }

    public function testUpdate()
    {
        $this->setupUser();
        $task = Task::inRandomOrder()->first();
        $status = TaskStatus::inRandomOrder()->first();
        $assignee = User::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status_id' => $status->id,
            'assigned_to_id' => $assignee->id
        ];
        $response = $this->patch(route('tasks.update', $task), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas(
            'tasks',
            array_merge(
                $data,
                ['id' => $task->id]
            )
        );
    }

    public function testDestroy()
    {
        $user = $this->setupUser();
        $task = Task::factory()->state([
            'created_by_id' => $user->id
        ])->create();

        $this->assertDatabaseHas('tasks', $task);

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', $task);
    }
}