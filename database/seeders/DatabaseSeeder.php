<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Nation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            NationSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class
        ]);

        $photos = Storage::allFiles('public');
        array_shift($photos);
        Storage::delete($photos);

        echo "\033[34m Storage Cleaned \n";
    }
}
