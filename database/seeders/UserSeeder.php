<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'name' => 'Admin',
    'email' => 'admin@pos.com',
    'password' => Hash::make('123'),
    'role' => 'admin'
]);

User::create([
    'name' => 'Kasir', 
    'email' => 'kasir@pos.com',
    'password' => Hash::make('123'),
    'role' => 'kasir'
        ]);
    }
}