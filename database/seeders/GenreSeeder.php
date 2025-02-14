<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = ['Hành động', 'Kinh dị', 'Hài hước', 'Tình cảm', 'Viễn tưởng'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}