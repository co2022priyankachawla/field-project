<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Secretary
        User::factory()->create([
            'name' => 'John Secretary',
            'email' => 'secretary@example.com',
            'role' => 'secretary',
            'password' => bcrypt('password'),
        ]);

        // Default Resident
        User::factory()->create([
            'name' => 'Alice Resident',
            'email' => 'resident@example.com',
            'role' => 'resident',
            'wing' => 'A',
            'floor' => 1,
            'password' => bcrypt('password'),
        ]);

        // Default Staff
        User::factory()->create([
            'name' => 'Mike Staff',
            'email' => 'staff@example.com',
            'role' => 'staff',
            'password' => bcrypt('password'),
        ]);
    }
}
