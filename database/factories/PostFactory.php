<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title' => $this->faker->sentence(10),
           'desc' => $this->faker->paragraph(),
           'image' => 'image.png',
           'user_id' => User::factory(),
           'tag_id' => Tag::factory(),
        ];
    }
}
