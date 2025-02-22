<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriName = $this->faker->word;
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->word),
        ];
    }
}
