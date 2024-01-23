{{-- x-app-layout =layoutsのapp.blade.phpを使用する --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '詳細' }}
        </h2>
    </x-slot>

    <a href="{{ route('edit', $article) }}">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark-text-gray-100">
                        {{-- float（浮かせる）でimgをどこに置くか指定する。今回は左側にimg、右側にline oneを配置。
                            sm:rounded-t-lg = 画面サイズがsm以上のとき、枠をlgサイズで丸くする。
                            srcでとぶのはサンプル画面サイト。URL末尾400はimgサイズ（サンプル画面サイトのみの書き方） --}}
                            {{-- articleモデルの持つimagesをimageに１つずつ取り出す。
                                asset('ファイルパス（固定値）'　. 繋ぐためのURL)でpublicディレクトリ配下の素材へのURLを取得する --}} 
                                @foreach ($article->images as $image)
                                <img class="float-left rounded-3xl" src="{{ asset('/storage/' . $image->img_path) }}" style="width: 300px">    
                                @endforeach
                                
                                <p>{{ $article->shop_url}}</p>     

                                <p>{{ $article->makeup_date }}</p>
                                
                        {{-- 数字をもとに★の数を表示する。str_repeatで'文字列'を$の値分繰り返して表示する --}}
                        <p>お気に入り{{ str_repeat('★', $article->favorite)}}</p>       

                        <p>再現度{{ $article->reproduction }}</p>
                        {{-- @for ($i = 0; $i < {{ $article->reproduction }}; $i++)
                        ★;
                        @endfor --}}
                        
                        <p>スタイル：{{ $article->hair_length }}</p>
                        
                        <p>{{ $article->report }}</p>                        
                    </div>
                </div>
            </div>
        </div>
    </a>
</x-app-layout>
