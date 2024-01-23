<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * index:一覧ページ
     * 
     */
    public function index()
    {
        $articles = Article::latest()->get();        
        return view('orderby', compact('articles'));
    }

    /**
     * create:作成ページ
     */
    public function create()
    {
        return view('publish');
    }

    /**
     * store：作成機能
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->shop_url = $request->input('shop_url');
        $article->makeup_date = $request->input('makeup_date');
        $article->favorite = $request->input('favorite');
        $article->reproduction = $request->input('reproduction');
        $article->hair_length = $request->input('hair_length');
        $article->report = $request->input('report');
        $article->save(); 

        foreach ($request->images as $input_image) {
            $image = new Image();
            $image->img_path = $input_image->store('images'); 
            $image->article_id = $article->id;  
            $image->save();
        }
        return redirect()->intended(RouteServiceProvider::HOME); 
    }

    /**
     * showアクション：詳細ページ
     */
    public function show(Article $article)
    {
        $comments = $article->comments()->get();
        return view('show', compact('article', 'comments'));
    }

    /**
     * editアクション；編集ページ
     */
    public function edit(Article $article)
    {
        //TODO:コメントアウトを外す（エラー表示されるようにする）
        // その記事が属するユーザーIDと現在ログイン中のユーザーIDを比較し、異なる場合はreturnで別ページにリダイレクトさせる（他人の投稿を編集できないようにするため）→転職活動のため」一旦コメントアウトのまま
        // if ($article->user_id !== Auth::id()) {
        //     return redirect()->route('dashboard')->with('error_message', '不正なアクセスです');
        // }
        return view('edit', compact('article')); //ひとつのarticleデータを持つeditビュー。編集するのでデータが必要
    }

    /**
     * updateアクション：記事の編集機能
     */
    public function update(Request $request, Article $article)
    {
        $comments = $article->comments()->get();

        $article->shop_url = $request->input('shop_url');
        $article->makeup_date = $request->input('makeup_date');
        $article->favorite = $request->input('favorite');
        $article->reproduction = $request->input('reproduction');
        $article->hair_length = $request->input('hair_length');
        $article->report = $request->input('report');
        $article->save();

        if ($request->file('input_images')) {
            Image::where('article_id','=', $article->id)->delete(); 
            foreach ($request->input_images as $input_image) {
                $image = new Image();
                $image->img_path = $input_image->store('images'); 
                $image->article_id = $article->id;
                $image->save();
            }
        }

        return redirect()->route('show', ['article' => $article]); 
    }

    /**
     * destroyアクション；削除機能
     * 
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('dashboard');
    }

    //latestアクション(最新順)
    public function latest()
    {
        $articles = Article::latest()->get();
        return view('orderby', compact('articles'));
    }

    //favoriteアクション（お気に入り順）
    public function favorite() 
    {
        $articles = Article::where('favorite', '>=', 7)-> orderByDesc('favorite')->get();
        return view('orderby', compact('articles'));
    }

    //再現率が7以上の記事を降順（日時が新しい順）に取得する
    public function reproduction()
    {
        $articles = Article::where('reproduction', '>=', 7)->orderByDesc('reproduction')->get();
        return view('orderby', compact('articles'));
    }

    //レングス別（TODO：編集中）
    public function length($condition)
    {
        $articles = Article::where('hair_length', $condition)->orderByDesc('hair_length')->get();
        return view('hair_length', compact('articles'));
    }

    //コメント数の多い順（かつ日時の新しい順）に取得
    public function count()
    {
        $articles = Article::withCount('comments')->orderByDesc('comments_count')->get();
        return view('orderby', compact('articles'));
    }

    //検索機能（ワード検索）
    public function search()
    {
        
        $search_word = request()->input('search_word');
        $search_result = Article::where('report', 'like', '%'.$search_word.'%')->latest()->get();
        return view('search', compact('search_result'));
    }

    //条件をつけることで、アクションをまとめる。この書き方だとレングス別までまとめられる
    //$conditionがroute名、$param1がhair_lengthのパラメータ（ショートとか）
    // public function searchRe($condition, $param1 = '')
    // {
    //     if($condition == 'latest'){
    //         $articles = Article::latest()->get();
    //     }
    //     elseif($condition == 'favorite'){
    //         $articles = Article::where('favorite', '>=', 7)->orderByDesc('favorite')->get();
    //     }
    //     elseif($condition == 'reproduction'){
    //         $articles = Article::where('reproduction', '>=', 7)->orderByDesc('reproduction')->get();
    //     }
    //     elseif($condition == 'length'){
    //         $articles = Article::where('hair_length', $param1)->orderByDesc('hair_length')->get();
    //     }
    //     elseif($condition == 'comments_count'){
    //         $articles = Article::withCount('comments')->orderByDesc('comments_count')->get();
    //     }
    //     else{
    //         $articles = Article::all();
    //     }
    //     return view('orderby', compact('articles'));
    // }
    
}
