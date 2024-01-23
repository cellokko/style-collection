<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(Image::class); //1つの記事は複数の画像を持っている（1対多）
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); //1つの記事に複数のコメントがつく（1対多）
    }
}
