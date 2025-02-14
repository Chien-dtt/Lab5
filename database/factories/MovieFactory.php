<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'poster' => 'https://via.placeholder.com/150', // Ảnh mẫu
            'intro' => $this->faker->paragraph(),
            'release_date' => $this->faker->date(),
            'genre_id' => Genre::inRandomOrder()->first()->id,
        ];
    }
}