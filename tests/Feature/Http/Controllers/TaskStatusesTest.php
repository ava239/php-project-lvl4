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
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $taskStatus = TaskStatus::inRandomOrder()->first();

        $response = $this->get(route('task_statuses.index'));

        $response->assertOk()
            ->assertSee($taskStatus->name);
    }

    public function testCreate()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $this->actingAs($this->user);

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
        $this->actingAs($this->user);

        $taskStatus = TaskStatus::inRandomOrder()->first();

        $response = $this->get(route('task_statuses.edit', $taskStatus));

        $response->assertOk()
            ->assertSee($taskStatus->name);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user);

        $taskStatus = TaskStatus::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->text(20)
        ];

        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $taskStatus->fill($data);
        $updatedTaskStatusData = $taskStatus->only('id', 'name');

        $this->assertDatabaseHas('task_statuses', $updatedTaskStatusData);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user);

        $taskStatus = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $taskStatusData = $taskStatus->only('id');
        $this->assertDatabaseMissing('task_statuses', $taskStatusData);
    }
}
