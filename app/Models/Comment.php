<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(Article::class); //1つのコメントは1つの記事に付属する（1対1）
    }

    public function user()
    {
        return $this->belongsTo(User::class); //そのコメントは一人のユーザーに付属する（1対1）
    }
}
