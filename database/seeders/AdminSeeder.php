<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        DB::table('users')->insert([
            'name' => 'Orevan',
            'email' => $email,
            'photo' => 'photo.png',
            'password' => Hash::make($password),
            'type' => 'admin',
            'status' => 'approved',
            'created_at' => now(),
        ]);
    }
}
