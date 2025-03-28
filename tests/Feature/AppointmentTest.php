<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    public function test_appointment_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/appointments');

        $response->assertStatus(200);
    }

    public function test_create_appointment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('appointments.store'), [
            'service_id' => 1,
            'appointment_time' => '2025-03-28 10:00:00'
        ]);

        $response->assertRedirect(route('appointments.index'));

        $this->assertDatabaseHas('appointments', [
            'service_id' => 1,
            'appointment_time' => '2025-03-28 10:00:00',
        ]);
    }
}
