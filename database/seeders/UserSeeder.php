<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();


        User::factory()->create([
            'name' => 'Kyal Sin Tun',
            'email' => 'cinkyal35@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('kyalc987')
        ]);

        User::factory()->create([
            'name' => 'Mr. Editor',
            'email' => 'editor@gmail.com',
            'role' => 'editor',
            'password' => Hash::make('password')
        ]);

        User::factory()->create([
            'name' => 'Mr. Author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
