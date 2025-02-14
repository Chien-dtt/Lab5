<?php

use App\Models\Genre;
use App\Models\Movie;
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
        ]);
    }
}