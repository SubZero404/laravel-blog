<?php

namespace Database\Seeders;

use App\Models\Nation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nations = ['myanmar','china','singapore','thailand','japan','korean'];
        foreach ($nations as $nation) {
            Nation::factory()->create([
               'name' => $nation
            ]);
        }
    }
}
