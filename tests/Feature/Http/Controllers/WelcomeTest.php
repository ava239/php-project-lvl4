<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function testWelcome()
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }
}
