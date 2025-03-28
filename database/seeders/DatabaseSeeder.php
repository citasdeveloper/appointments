<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Developer',
            'email' => 'dev@dev.com',
            'role' => 'admin',
        ]);

        for ($i=1; $i<=10; $i++) {
            Service::factory()->create([
                'name' => 'Service ' . $i,
                'description' => 'Service description ' . $i
            ]);
        }

    }
}
