<?php

use App\Models\Image;
use App\Models\Post;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('test');
// })->middleware(['auth', 'verified'])->name('dashboard');

//26~28の書き換え→dashboardルート：/dashboardアドレスはArticleControllerのindexアクションを呼び出す。アクセス前にauthがverifiedか確かめる
Route::get('/dashboard',[App\Http\Controllers\ArticleController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//Articleの新規投稿ページ（create）と、新規投稿機能（store）
Route::get('/create',[\App\Http\Controllers\ArticleController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
Route::post('/post',[App\Http\Controllers\ArticleController::class, 'store'])->middleware(['auth', 'verified']);

//headerリストの各ルート（最新、お気に入り、再現度、レングス、コメント数、検索）をコントローラでグループ化して記述
//Route::リクエスト('URL', 'アクション名')->name('ルート名');
Route::controller(ArticleController::class)->group(function(){
    Route::get('/latest', 'latest')->name('latest');
    Route::get('/favorite', 'favorite')->name('favorite');
    Route::get('/reproduction', 'reproduction')->name('reproduction');
    //URLに{}でパラメータつけると、レングスそれぞれ作らなくてOK
    Route::get('/length/{condition}', 'length')->name('hair_length');
    Route::get('/count', 'count')->name('comments_count');
    Route::get('/search', 'search')->name('search_word');
});

//簡略書き換え conditionとparam1?のパラメータを渡すことで、
// Route::get('/search/{condition}/{param1?}', [ArticleController::class, 'searchRe'])->name('searchre');


Route::get('/show/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('show');
Route::get('/edit/{article}', [\App\Http\Controllers\ArticleController::class, 'edit'])->name('edit');
Route::patch('/update/{article}',[\App\Http\Controllers\ArticleController::class, 'update'])->name('update');
Route::delete('/delete/{article}',[\App\Http\Controllers\ArticleController::class, 'destroy'])->name('destroy');

Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comment/{comment}',[\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::post('/comment/{comment}',[\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::delete('/comment/{comment}',[\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

//getはDBの検索や画面の呼び出し（新規登録は画面を呼び出すなのでget）、postはDBの登録や更新

//あくまで画面レイアウトの確認のためで、データを取得して表示する訳じゃないので仮URLを設定している
//第1がURL、第2が表示したいファイル（latest.blade.php）：/aiueoにつなぐとそのファイルが表示される
Route::view('/aiueo', 'publish'); 
//Route::view('/kakikukeko', 'latest'); 