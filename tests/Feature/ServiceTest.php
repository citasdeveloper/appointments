<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    public function test_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_create_service(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('services.store'), [
            'name' => 'Test',
            'description' => 'Test'
        ]);

        $response->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'name' => 'Test',
            'description' => 'Test',
        ]);
    }
}
