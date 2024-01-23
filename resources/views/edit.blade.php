{{-- x-app-layout =layoutsのapp.blade.phpを使用する --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '編集' }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 ml-30">
        <form action="{{ route('update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <table class="text-left leading-10">
                <tr class="h-20">
                    <th>店舗URL</th>
                    <td><input type="text" name="shop_url" value="{{ $article->shop_url }}"></td>
                </tr>
                <tr>
                    <th>投稿日時</th>
                    <td><input type="date" name="makeup_date" value="{{ $article->makeup_date }}"></td>
                </tr>
                <tr>
                    <th>現在の画像</th>
                    <td>
                        @foreach ($article->images as $image)
                            <img class="mt-10 mb-10 float-left rounded-3xl w-24 sm:w-80"
                                src="{{ asset('/storage/' . $image->img_path) }}">
                        @endforeach

                    </td>
                </tr>
                <tr>
                    <th>画像を変更する</th>
                    <td><input type="file" name="input_images[]" multiple></td>
                </tr>
                <tr>
                    <th class="h-20">お気に入り</th>
                    <td>
                        <select name="favorite">
                            <option value="10" @selected($article->favorite === 10)>★★★★★★★★★★</option>
                            <option value="9" @selected($article->favorite === 9)>★★★★★★★★★</option>
                            <option value="8" @selected($article->favorite === 8)>★★★★★★★★</option>
                            <option value="7" @selected($article->favorite === 7)>★★★★★★★</option>
                            <option value="6" @selected($article->favorite === 6)>★★★★★★</option>
                            <option value="5" @selected($article->favorite === 5)>★★★★★</option>
                            <option value="4" @selected($article->favorite === 4)>★★★★</option>
                            <option value="3" @selected($article->favorite === 3)>★★★</option>
                            <option value="2" @selected($article->favorite === 2)>★★</option>
                            <option value="1" @selected($article->favorite === 1)>★</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="h-10">自宅での再現率</th>
                    <td>
                        <select name="reproduction">
                            <option value="10" @selected($article->reproduction === 10)>★★★★★★★★★★</option>
                            <option value="9" @selected($article->reproduction === 9)>★★★★★★★★★</option>
                            <option value="8" @selected($article->reproduction === 8)>★★★★★★★★</option>
                            <option value="7" @selected($article->reproduction === 7)>★★★★★★★</option>
                            <option value="6" @selected($article->reproduction === 6)>★★★★★★</option>
                            <option value="5" @selected($article->reproduction === 5)>★★★★★</option>
                            <option value="4" @selected($article->reproduction === 4)>★★★★</option>
                            <option value="3" @selected($article->reproduction === 3)>★★★</option>
                            <option value="2" @selected($article->reproduction === 2)>★★</option>
                            <option value="1" @selected($article->reproduction === 1)>★</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>スタイル</th>
                    <td class="flex mt-10 mb-10">
                        <input type="radio" name="hair_length" id="a"
                            value="ベリーショート"{{ old('hair_length', $article->hair_length) == 'ベリーショート' ? 'checked' : '' }}>
                        <label for="a">ベリーショート<img src="{{ asset('img/very_short_hair.png') }}"
                                width="150px"></label>

                        <input type="radio" name="hair_length" id="b"
                            value="ショート"{{ old('hair_length', $article->hair_length) == 'ショート' ? 'checked' : '' }}>
                        <label for="b">ショート<img src="{{ asset('img/short_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="c"
                            value="ボブ"{{ old('hair_length', $article->hair_length) == 'ボブ' ? 'checked' : '' }}>
                        <label for="c">ボブ<img src="{{ asset('img/bob_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="d"
                            value="ミディアム"{{ old('hair_length', $article->hair_length) == 'ミディアム' ? 'checked' : '' }}>
                        <label for="d">ミディアム<img src="{{ asset('img/medium_hair.png') }}"
                                width="150px"></label>

                        <input type="radio" name="hair_length" id="e"
                            value="ロング"{{ old('hair_length', $article->hair_length) == 'ロング' ? 'checked' : '' }}>
                        <label for="e">ロング<img src="{{ asset('img/long_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="f"
                            value="その他"{{ old('hair_length', $article->hair_length) == 'その他' ? 'checked' : '' }}>
                        <label for="f">その他<img src="{{ asset('img/other_style.png') }}" width="150px"></label>
                    </td>
                </tr>
                <tr>
                    <th>投稿内容</th>
                    <td>
                        <textarea class="form-control" name="report" style="width: max-content">{{ $article->report }}</textarea>
                    </td>
                </tr>
            </table>
            <button type="submit"
                class="px-6 py-2 flex item-center justify-center rounded-md bg-black text-white">更新</button><br>
        </form>
        <form action="{{ route('destroy', $article) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit"
                class="px-6 py-2 flex item-center justify-center rounded-md border border-gray-300 bg-gray-300">このコメントを削除する
            </button>
        </form>
    </div>
    {{-- <div class="py-3 form-group mb-3">
                <label for="">店舗URL</label>
                </div> --}}
    {{-- <div class="form-group mb-3">
                    <label for="">日時</label>
                    @dump($article->makeup_date)
                    <input type="date" name="makeup_date" value="{{ $article->makeup_date }}">
                </div> --}}
    {{-- <div class="py-5 form-group mb-3 flex">
                    @foreach ($article->images as $image)
                        <img class="float-left rounded-3xl w-24 sm:w-80"
                            src="{{ asset('/storage/' . $image->img_path) }}">
                    @endforeach
                </div> --}}
    {{-- <div class="py-5">
                    <input type="file" name="input_images[]" multiple>
                </div> --}}
    {{-- <div class="py-3 form-group mb-3">
                    <label>お気に入り</label>
                    <select name="favorite">
                        <option value="5" @selected($article->favorite === 5)>★★★★★</option>
                        <option value="4" @selected($article->favorite === 4)>★★★★</option>
                        <option value="3" @selected($article->favorite === 3)>★★★</option>
                        <option value="2" @selected($article->favorite === 2)>★★</option>
                        <option value="1" @selected($article->favorite === 1)>★</option>
                    </select>
                </div> --}}
    {{-- <div class="form-group mb-3">
                    <label for="">再現度</label>
                    <select name="reproduction">
                        <option value="5" @selected($article->reproduction === 5)>★★★★★</option>
                        <option value="4" @selected($article->reproduction === 4)>★★★★</option>
                        <option value="3" @selected($article->reproduction === 3)>★★★</option>
                        <option value="2" @selected($article->reproduction === 2)>★★</option>
                        <option value="1" @selected($article->reproduction === 1)>★</option>
                    </select>
                </div> --}}

    {{-- <div class="py-3 form-group mb-3">
                    <h5>スタイル</h5>
                    <div class="py-2 flex"> --}}
    {{-- {{old('name', 第1がないときの初期値)}}で、nameの入力値を取得。三項演算子をつけることでバリデーションに引っかかった時（エラー時）も外れず維持できる。hair_lengthがベリーショートだったらチェック、そうでなければ''なし。 --}}
    {{-- <input type="radio" name="hair_length" id="a"
                            value="ベリーショート"{{ old('hair_length', $article->hair_length) == 'ベリーショート' ? 'checked' : '' }}>
                        <label for="a">ベリーショート<img src="{{ asset('img/very_short_hair.png') }}"
                                width="150px"></label>

                        <input type="radio" name="hair_length" id="b"
                            value="ショート"{{ old('hair_length', $article->hair_length) == 'ショート' ? 'checked' : '' }}>
                        <label for="b">ショート<img src="{{ asset('img/short_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="c"
                            value="ボブ"{{ old('hair_length', $article->hair_length) == 'ボブ' ? 'checked' : '' }}>
                        <label for="c">ボブ<img src="{{ asset('img/bob_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="d"
                            value="ミディアム"{{ old('hair_length', $article->hair_length) == 'ミディアム' ? 'checked' : '' }}>
                        <label for="d">ミディアム<img src="{{ asset('img/medium_hair.png') }}"
                                width="150px"></label>

                        <input type="radio" name="hair_length" id="e"
                            value="ロング"{{ old('hair_length', $article->hair_length) == 'ロング' ? 'checked' : '' }}>
                        <label for="e">ロング<img src="{{ asset('img/long_hair.png') }}" width="150px"></label>

                        <input type="radio" name="hair_length" id="f"
                            value="その他"{{ old('hair_length', $article->hair_length) == 'その他' ? 'checked' : '' }}>
                        <label for="f">その他<img src="{{ asset('img/other_style.png') }}" width="150px"></label>
                    </div>
                </div> --}}
    {{-- <div class="py-3 form-group mb-3">
                    <label for="">レポート</label>
                    <div class="py-3">
                        <textarea class="form-control" name="report" style="width: max-content">{{ $article->report }}</textarea>
                    </div>
                </div>
            </table> --}}


</x-app-layout>
