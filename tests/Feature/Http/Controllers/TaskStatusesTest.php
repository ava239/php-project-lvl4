<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private bool $seed = true;

    public function setupUser()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function testIndex()
    {
        $taskStatus = TaskStatus::first();
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk()
            ->assertSee($taskStatus->name);
    }

    public function testCreate()
    {
        $this->setupUser();
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $this->setupUser();
        $data = [
            'name' => $this->faker->text(20)
        ];
        $response = $this->post(route('task_statuses.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit()
    {
        $this->setupUser();
        $taskStatus = TaskStatus::inRandomOrder()->first();
        $response = $this->get(route('task_statuses.edit', $taskStatus));
        $response->assertOk()
            ->assertSee($taskStatus->name);
    }

    public function testUpdate()
    {
        $this->setupUser();
        $taskStatus = TaskStatus::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->text(20)
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', array_merge(['id' => $taskStatus->id], $data));
    }

    public function testDestroy()
    {
        $this->setupUser();
        $taskStatus = TaskStatus::factory()->create();

        $taskStatusData = $taskStatus->only('id', 'name');
        $this->assertDatabaseHas('task_statuses', $taskStatusData);

        $response = $this->delete(route('task_statuses.destroy', $taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', $taskStatusData);
    }
}
