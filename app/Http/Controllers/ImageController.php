<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //フォームのimages[]を配列で取得し、$input_iamgeに代入して取り出す。配列の数だけ繰り返す
        // foreach ($request->images as $input_image) {
        //     $image = new Image();
        //     $image->img_path = $input_image->store('images'); //取り出したデータをimagesフォルダに保存し、戻り値のファイルパスをimg_pathに代入
        //     $image->article_id = $article->id;  //postテーブルのidをimagesテーブルのpost_idに代入
        //     $image->save();
        // }
        // return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
