<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@akashtours.com',
        ], [
            'name' => 'Akash Tours Admin',
            'password' => Hash::make('Admin@12345'),
            'is_admin' => true,
        ]);

        $this->call(TourSeeder::class);
    }
}
