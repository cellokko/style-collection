<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>画像アップロードサンプル</h4>
    <!-- enctype="multipart/form-data"をフォームに設定すると画像ファイルを送信できる（コントローラで受け取れる -->
    <form action="/post" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- type="file"で画像ファイルを選択して入力できる -->
        <!-- imageを複数枚選択できるようにimages[]とmultipleを設置 -->
        <input type="textarea" name="report" value="あいうえお"><br>
        <input type="file" name="images[]" multiple><br>
        <input type="submit" value="送信"><br>
    </form>

    foreach (\App\Models\Article::all() as $article)
    <!--1つの画像アップロード機能:asset()で/storage/ディレクトリ内にあるimg_pathを１ずつ取り出す-->
        <!-- <img src="{{ asset('/storage/' . $post->img_path) }}" style="width: 200px">
        
        $article->comment
        3つの画像アップロード機能：path1を取り出す。nullはないため必ず存在する
        <img src="{{ asset('/storage/' . $post->img_path1) }}" style="width: 100px">
        path2,path3が存在すれば画像を表示する
        @if ($post->img_path2)  
            <img src="{{ asset('storage/' . $post->img_path2) }}" style="width: 100px">
        @endif
        @if ($post->img_path3)
            <img src="{{ asset('/storage/' . $post->img_path3) }}" style="width: 100px">
        @endif -->
        
        <!-- postテーブルが持っているimageではなく、postモデルで設定したimages（リレーション）のこと -->
        @foreach ($article->images as $image)             
            <img src="{{ asset('/storage/' . $image->img_path) }}" style="width: 100px">            
        @endforeach
        <br>
    @endforeach
</body>

</html>