<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use Tests\TestCase;

class TaskStatusesTest extends TestCase
{
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
        $updateData = [
            'name' => $this->faker->text(20)
        ];

        $response = $this->patch(route('task_statuses.update', $taskStatus), $updateData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $updatedTaskStatusData = array_merge($updateData, ['id' => $taskStatus->id]);

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
