<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'img_path' => 'tBZdYo0Ehc473Z2DRzUAHBF5LNQBobOKb0msYDUb.png', //ランダムで生成せず1つに固定
            'img_path' => Str::random(25). '.png', //.が接続になる
            'article_id' => Article::factory(),  //fake()->randomNumber(2), //2桁までのランダムな整数
        ];
    }
}
