<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => $this->faker->unique()->title,
            'content' => $this->faker->unique()->text,
            'uuid'=>Str::uuid(),
        ];
    }

    public function disableSync()
    {
        return $this->state([
            'sync' => false,
        ]);
    }
}
