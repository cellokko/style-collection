<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory()->count(3)->create();
        //Article::factory()->count(3)->create(['title' => 'A']); 3つデータ作り、タイトルのみ上書きする
        //Article::factory()->count(3)->create(['title' => 'B']);
    }
}
