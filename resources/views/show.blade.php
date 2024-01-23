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
                        {{-- ループ変数を使い、「もし最初の画像であればfloat-leftにし、そうでなければしない」と設定。こうすると画像が横並びになる。←検証画面で探索した結果。
                        @foreach ($article->images as $image)
                            @if ($loop->first)
                                <img class="float-left rounded-3xl" src="{{ asset('/storage/' . $image->img_path) }}"
                                    style="width: 300px">
                            @else
                                <img class="rounded-3xl" src="{{ asset('/storage/' . $image->img_path) }}"
                                    style="width: 300px">
                            @endif
                        @endforeach --}}

                        <div class="flex">
                            @foreach ($article->images as $image)
                                <img class="rounded-3xl w-24 sm:w-80" src="{{ asset('/storage/' . $image->img_path) }}">
                            @endforeach
                        </div>
                        <div class="mt-4 gap-1 grid grid-cols-1" >
                            <div>店舗URL &nbsp;{{ $article->shop_url }}</div>
                            <div>投稿日時 &nbsp;{{ $article->makeup_date }}</div>
                            <div class="flex">
                                <p>お気に入り &nbsp;</p>
                                @for ($i = 0; $i < config('app.star_max'); $i++)
                                    @if ($article->favorite-- > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>

                       
                        <div class="flex">
                            <p>自宅での再現率 &nbsp;</p>
                            @for ($i = 0; $i < config('app.star_max'); $i++)
                                @if ($article->reproduction-- > 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p>スタイル：{{ $article->hair_length }}</p>
                        <p>{{ $article->report }}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>

    {{-- border-b-2が下線で太さ2。border-whiteで色を指定 --}}
    <div class="py-3">
        <div class="bg-white shadow-sm border rounded-md border-white">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">ユーザーコメント</h2>
            </div>
        </div>
    </div>

    <div>
        {{-- aricleに紐づいたコメントのみをひっぱってくると、コントローラで渡さなくてもよくなる。
            $article->comments ?? ''：articleにコメントがあれば表示、??なければ''なし。 --}}
        @foreach ($article->comments ?? '' as $comment)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p class="text-xl">{{ $comment->content }}</p>
                <label class="text-sm">{{ $comment->created_at }} {{ $comment->user->name }}</label>
                {{-- @dd($article) --}}
                @if ($comment->user_id === Auth::user()->id)
                    <a href="{{ route('comments.edit', ['comment' => $comment]) }}">
                        <x-primary-button type=submit>このコメントを編集する</x-primary-button>
                    </a>
                @endif
                {{-- @dump($comment->user_id)
                @dump(Auth::user()->id) --}}
            </div>
        @endforeach
    </div><br>

    @auth
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <p class="text-xl">コメント内容</p>
                    @error('content')
                        <strong>コメント内容を入力してください</strong>
                    @enderror
                    <textarea name="content"></textarea><br>
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <br>
                    <x-primary-button type="submit">コメントを投稿</x-primary-button>

                    {{-- 薄い青の背景で濃い青文字
                    <button type="submit"
                        class="bg-blue-100 text-blue-600 text-base font-semibold px-6 py-2 rounded-lg">コメントを投稿</button>
                    黒背景で白抜き文字
                    <button type="submit"
                        class="px-6 py-2 flex item-center justify-center rounded-md bg-black text-white">コメントを投稿</button>
                    グレー背景のグレー文字
                    <button type="submit"
                        class="px-6 py-2 flex item-center justify-center rounded-md border border-gray-300">コメントを投稿</button> --}}
                </form>
            </div>
        </div>
    @endauth
</x-app-layout>
