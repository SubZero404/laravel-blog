<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();


        $categories = ['IT News','Sport','Food and Drinks','Travel','Gaming','Nature'];
        foreach ($categories as $category) {
            Category::factory()->create([
                'title' => $category,
                'slug' => Str::slug($category),
                'user_id' => User::inRandomOrder()->first()->id
            ]);
        }

        Post::factory(100)->create();


        User::factory()->create([
            'name' => 'Kyal Sin Tun',
            'email' => 'cinkyal35@gmail.com',
            'password' => Hash::make('kyalc987')
        ]);
    }
}
