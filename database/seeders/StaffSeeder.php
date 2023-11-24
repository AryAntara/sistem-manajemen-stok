<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\Staff::factory()->create([
            'name' => 'Test User',
            'username' => "Test",
            'password' => Hash::make('12345678'),
            'deleted_at' => null
        ]);
    }
}
