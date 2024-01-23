<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Stringable;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_url' => Str::random(15), 
            'makeup_date' => fake()->date(),
            'favorite' => fake()->numberBetween(1,6),
            'reproduction' => fake()->numberBetween(1,6),
            'hair_length' => fake()->numberBetween(1,6),
            'report' => fake()->realText(60), //第1は最大文字数、第2はサイズ 

            // 'title' => fake()->name(), //仮で姓名にする
            // 'report' => fake()->realText(100), //第1は最大文字数、第2はサイズ
            // 'comment' => fake()->realText(50),
            // 'user_id' => User::factory(),
            // //第1は桁数1～9、第2は初期値falseで桁数非固定
            // 'user_name' => fake()->firstName(), //名のみ

         ];
    }
}