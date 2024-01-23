{{-- x-app-layout =layoutsのapp.blade.phpを使用する --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '編集' }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group mb-3">
                <label for="">店舗URL</label>
                <input type="text" name="shop_url" value="{{ $article->shop_url }}">
            </div>
            <div class="form-group mb-3">
                <label for="">日時</label>
                {{-- @dump($article->makeup_date) --}}
                <input type="date" name="makeup_date" value="{{ $article->makeup_date }}">
            </div>
            <div class="form-group mb-3">
                <input type="file" name="images[]" multiple>
            </div>
            <div class="form-group mb-3">
                {{-- <input type="number" name="favorite" value="3"> --}}
                {{-- selectのoptionにはselected(条件式)をつけることで、条件になったら選択されるようにできる
                    このとき===とより厳格な条件にしておくのがbetter。上手くいかなかったら==など減らしていく --}}
                <label>お気に入り</label>
                <select name="favorite">
                    <option value="5" @selected($article->favorite === 5)>★★★★★</option>
                    <option value="4" @selected($article->favorite === 4)>★★★★</option>
                    <option value="3" @selected($article->favorite === 3)>★★★</option>
                    <option value="2" @selected($article->favorite === 2)>★★</option>
                    <option value="1" @selected($article->favorite === 1)>★</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">再現度</label>
                <select name="reproduction">
                    <option value="5" @selected($article->reproduction === 5)>★★★★★</option>
                    <option value="4" @selected($article->reproduction === 4)>★★★★</option>
                    <option value="3" @selected($article->reproduction === 3)>★★★</option>
                    <option value="2" @selected($article->reproduction === 2)>★★</option>
                    <option value="1" @selected($article->reproduction === 1)>★</option>
                </select>
                {{-- <input type="number" name="reproduction" value="5"> --}}
            </div>
            <div class="form-group mb-3">
                {{-- select>option*3で3つプルダウンができる：emmet --}}
                <label for="">スタイル</label>
                <select name="hair_length">
                    {{-- valueはデータベースに送る値。ショートは画面上の表示 --}}
                    {{-- TODO selectedとvalueを消す --}}
                    <option value="1">ショート</option>
                    <option value="2" selected>ボブ</option>
                    <option value="3">ロング</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">レポート</label>
                <textarea class="form-control" name="report" style="width: max-content">{{ $article->report }}</textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</x-app-layout>
