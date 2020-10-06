<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        Label::factory()->count(3)->create();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $label = Label::inRandomOrder()->first();

        $response = $this->get(route('labels.index'));

        $response->assertOk()
            ->assertSee($label->name);
    }

    public function testCreate()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $this->actingAs($this->user);

        $data = [
            'name' => $this->faker->text(20)
        ];
        $response = $this->post(route('labels.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit()
    {
        $this->actingAs($this->user);

        $label = Label::inRandomOrder()->first();

        $response = $this->get(route('labels.edit', $label));

        $response->assertOk()
            ->assertSee($label->name);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user);

        $label = Label::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->text(20)
        ];

        $response = $this->patch(route('labels.update', $label), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $label->fill($data);
        $updatedLabelData = $label->only('id', 'name');

        $this->assertDatabaseHas('labels', $updatedLabelData);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user);

        $label = Label::factory()->create();

        $response = $this->delete(route('labels.destroy', $label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $labelData = $label->only('id');
        $this->assertDatabaseMissing('labels', $labelData);
    }
}
