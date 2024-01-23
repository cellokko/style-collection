{{-- x-app-layout =layoutsのapp.blade.phpを使用する --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '新規投稿' }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="/post" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- TODO valueのaiueoを消す --}}
            <div class="form-group mb-3">
                <label for="">店舗URL</label>
                <input type="text" name="shop_url" value="aiueo">
            </div>
            <div class="form-group mb-3">
                <label for="">日時</label>
                <input type="datetime-local" name="makeup_date" value="{{ now() }}">
            </div>
            <div class="form-group mb-3">
                <input type="file" name="images[]" multiple>
            </div>
            <div class="form-group mb-3">
                {{-- <input type="number" name="favorite" value="3"> --}}
                <label>お気に入り</label>
                <select name="favorite">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">再現度</label>
                <select name="reproduction">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
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
                <textarea class="form-control" name="report" style="width: max-content">レポート</textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit">投稿</button>
            </div>
        </form>
    </div>
</x-app-layout>
