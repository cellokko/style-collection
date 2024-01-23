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
     * お気に入り・再現度の★：$max_count = 5 星のmax値→config/app.phpで設定し、ビューで直接呼び出すに変更
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
        //フォームの入力内容を取得しarticlesテーブルの各カラムに代入（まだviewのname等が整っていない時は任意のデータをいれる）
        $article = new Article();
        $article->shop_url = $request->input('shop_url');
        $article->makeup_date = $request->input('makeup_date');
        $article->favorite = $request->input('favorite');
        $article->reproduction = $request->input('reproduction');
        $article->hair_length = $request->input('hair_length');
        $article->report = $request->input('report');
        $article->save(); //カラムに保存して初めて、この時点でidが発行される。idがないと45のaritcle_idでエラーとなる

        //ビューからimages[]を取得。$input_imageに代入して取り出す。配列の数だけ繰り返すことで複数枚でもアップロードできる
        foreach ($request->images as $input_image) {
            $image = new Image();
            $image->img_path = $input_image->store('images'); //取り出したデータをstore()でimagesフォルダに保存（デフォルトでstoratge/appフォルダ。その後続けるパスのみでOK）、戻り値のファイルパスをimg_pathに代入
            $image->article_id = $article->id;  //articleテーブルのidをimagesテーブルのarticle_idに代入
            $image->save();
        }
        return redirect()->intended(RouteServiceProvider::HOME); //intended(意図された):値があればそこへリダイレクト、なければ'/'にリダイレクト
    }

    /**
     * showアクション：詳細ページ
     * DBの値を変更せずページだけ開くのでreturn view()でOK
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
        // その記事が属するユーザーIDと現在ログイン中のユーザーIDを比較し、異なる場合はreturnで別ページにリダイレクトさせる（他人の投稿を編集できないようにするため）
        // if ($article->user_id !== Auth::id()) {
        //     return redirect()->route('dashboard')->with('error_message', '不正なアクセスです');
        // }
        return view('edit', compact('article')); //ひとつのarticleデータを持つeditビュー。編集するのでデータが必要
    }

    /**
     * updateアクション：記事の編集機能
     * DBの値を変更するので、再接続するreturn redirect()がのぞましい
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

        // もしimagesが取得できれば、まずは全件削除してその後新しい画像を保存する（上書きになる）。画像更新がない場合があるため、if文でつくる。
        // Storage::disk('ディスク')->delte('ファイルパス');でstorageディレクトリに保存された画像ファイルを削除。
        // ディスクはstore()メソッドの引数に設定したものと同じ。
        //file->
        if ($request->file('input_images')) {
            //ビューからimages[]を取得。$input_imageに代入して取り出す。配列の数だけ繰り返すことで複数枚でもアップロードできる
            //Imageモデルのarticle_idとarticleテーブルのidが同じものを取得し、全件消去する
            Image::where('article_id','=', $article->id)->delete(); //whereは＝の条件式のみ省略できる’＝’はなくてもOK
            foreach ($request->input_images as $input_image) {
                $image = new Image();
                $image->img_path = $input_image->store('images'); //取り出したデータをstore()でimagesフォルダに保存（デフォルトでstoratge/appフォルダ。その後続けるパスのみでOK）、戻り値のファイルパスをimg_pathに代入
                $image->article_id = $article->id;  //articleテーブルのidをimagesテーブルのarticle_idに代入
                $image->save();
            }
        }

        return redirect()->route('show', ['article' => $article]); //
        //return view('show', compact('article', 'comments'));
    }

    /**
     * destroyアクション；削除機能
     * 特定のデータを消すため、Articleモデルのデータを使用する宣言をしている
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
        //return view('latest', ['articles' => Article::latest()->get()]); //latestのビューに配列データを変数articleとして持たせる
        //return Article::latest()->get();　＝Articleモデルを通してテーブルの全インスタンスをlatest（最新順）で取得
    }

    //favoriteアクション（お気に入り順）
    public function favorite() 
    {
        //クエリビルダの検索：DB::table('users')->orderBy();
        //whereでname'favorite'の値が7以上のArticleインスタンスを検索し、desc順（降順：日時が新しい順）に取得する
        //orderByDesc('並べ替えるカラム名')
        $articles = Article::where('favorite', '>=', 7)-> orderByDesc('favorite')->get();
        //dd($favorite_articles);
        return view('orderby', compact('articles'));
    }

    //再現率が7以上の記事を降順（日時が新しい順）に取得する
    public function reproduction()
    {
        $articles = Article::where('reproduction', '>=', 7)->orderByDesc('reproduction')->get();
        return view('orderby', compact('articles'));
    }

    //レングス別（TODO：編集中）
    //web.phpに記述した{}の値をfunction　＊＊()でとってこれる。{$condition}はnavigationで渡している
    public function length($condition)
    {
        //dump($condition);
        //navigationのroute()の第2引数で渡した値（ショートとか）をhair_lengthカラムの$conditionとしてwhere区で検索して取得する
        $articles = Article::where('hair_length', $condition)->orderByDesc('hair_length')->get();
        return view('hair_length', compact('articles'));
    }

    //コメント数の多い順（かつ日時の新しい順）に取得
    public function count()
    {
        //Articleモデルにリレーションしている'comments'の数をカウントし、降順（数の大きい順）で取得する
        //Model::withCount('comments')->orderByDesc('comments_count')->get();
        $articles = Article::withCount('comments')->orderByDesc('comments_count')->get();
        return view('orderby', compact('articles'));
    }

    //検索機能（ワード検索）
    public function search()
    {
        //input boxからgetでURLに渡されたワードを取得
        $search_word = request()->input('search_word');
        //Articleモデルのreportカラムで$search_wordを含むデータを最新順に取得する
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

    //まとめ方その２
    
}
