<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Storeアクション；コメントの作成機能
     */
    public function store(Request $request)
    {
        //コメント内容に入力必須のバリデーションを設定する
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id; //コメントを作成したユーザーIDを取得
        $comment->user_name = Auth::user()->name;
        $comment->article_id = $request->input('article_id');
        $comment->content = $request->input('content');
        $comment->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {   
        if (Auth::user()->id !== $comment->user_id ){
            abort(500);
        }
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article, Comment $comment)
    {
        if (Auth::user()->id !== $comment->user_id ){
            abort(500); //abortはエラー画面を返す　404not foundとか
        }
        $comment->content = $request->input('content');
        $comment->save();
        //コメントテーブルのarticle_idを取得。idがないと1つのレコードに絞れない
        $article = Article::find($comment->article_id); 
        
        return redirect()->route('show', compact('article'));
    }

    /**
     * destroyアクション（削除機能）
     */
    public function destroy(Article $article, Comment $comment)
    {   
        //$comment = Comment::find($comment->id);
        //dd($comment);
        $comment->delete();
        $article = Article::find($comment->article_id); 

        return redirect()->route('show', compact('article'));
    }
}
