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

    public function setUp(): void
    {
        parent::setUp();
        Label::factory()->count(3)->create();
    }

    public function setupUser()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function testIndex()
    {
        $label = Label::first();
        $response = $this->get(route('labels.index'));
        $response->assertOk()
            ->assertSee($label->name);
    }

    public function testCreate()
    {
        $this->setupUser();
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $this->setupUser();
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
        $this->setupUser();
        $label = Label::inRandomOrder()->first();
        $response = $this->get(route('labels.edit', $label));
        $response->assertOk()
            ->assertSee($label->name);
    }

    public function testUpdate()
    {
        $this->setupUser();
        $label = Label::inRandomOrder()->first();
        $data = [
            'name' => $this->faker->text(20)
        ];
        $response = $this->patch(route('labels.update', $label), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', array_merge(['id' => $label->id], $data));
    }

    public function testDestroy()
    {
        $this->setupUser();
        $label = Label::factory()->create();

        $labelData = $label->only('id', 'name');
        $this->assertDatabaseHas('labels', $labelData);

        $response = $this->delete(route('labels.destroy', $label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', $labelData);
    }
}
