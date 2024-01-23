<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '新規投稿' }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 ml-30">
        <form action="/post" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="text-left leading-10">
                    <tr class="h-20">
                        <th>店舗URL</th>
                        <td><input type="text" name="shop_url"></td>
                    </tr>
                    <tr>
                        <th>日時</th>
                        <td><input type="datetime-local" name="makeup_date" value="{{ now() }}"></td>
                    </tr>
                    <tr class="h-20">
                        <th>画像選択</th>
                        <td><input type="file" name="images[]" multiple></td>
                    </tr>
                    <tr>
                        <th>お気に入り</th>
                        <td> <select name="favorite">
                                <option value="10">★★★★★★★★★★</option>
                                <option value="9">★★★★★★★★★</option>
                                <option value="8">★★★★★★★★</option>
                                <option value="7">★★★★★★★</option>
                                <option value="6">★★★★★★</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3">★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                            </select></td>
                    </tr>
                    <tr class="h-20">
                        <th>自宅での再現率</th>
                        <td> <select name="reproduction">
                                <option value="10">★★★★★★★★★★</option>
                                <option value="9">★★★★★★★★★</option>
                                <option value="8">★★★★★★★★</option>
                                <option value="7">★★★★★★★</option>
                                <option value="6">★★★★★★</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3">★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th>スタイル</th>
                        <td class="flex"> <input type="radio" name="hair_length" id="a" value="ベリーショート">
                            <label for="a">ベリーショート<img src="{{ asset('img/very_short_hair.png') }}"
                                    width="150px"></label>

                            <input type="radio" name="hair_length" id="b" value="ショート">
                            <label for="b">ショート<img src="{{ asset('img/short_hair.png') }}"
                                    width="150px"></label>

                            <input type="radio" name="hair_length" id="c" value="ボブ">
                            <label for="c">ボブ<img src="{{ asset('img/bob_hair.png') }}" width="150px"></label>

                            <input type="radio" name="hair_length" id="d" value="ミディアム">
                            <label for="d">ミディアム<img src="{{ asset('img/medium_hair.png') }}"
                                    width="150px"></label>

                            <input type="radio" name="hair_length" id="e" value="ロング">
                            <label for="e">ロング<img src="{{ asset('img/long_hair.png') }}" width="150px"></label>

                            <input type="radio" name="hair_length" id="f" value="その他">
                            <label for="f">その他<img src="{{ asset('img/other_style.png') }}"
                                    width="150px"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>投稿内容</th>
                        <td>
                            <textarea class="form-control" name="report" style="width: max-content" placeholder="自由に記述できます"></textarea>
                        </td>
                    </tr>
            </table>
            <div class="form-group mt-5 mb-3">
                <x-primary-button type="submit">投稿する</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
