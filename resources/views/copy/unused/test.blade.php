{{-- x-app-layout =layoutsのapp.blade.phpを使用する --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '投稿の一覧' }}
        </h2>
        {{-- sessionにerror_messageがあればその値を表示する --}}
        @if (session('error_message'))
            <p>{{ session('error_message') }}</p>
        @endif
    </x-slot>

    @foreach ($articles as $article)
        <a href="{{ route('show', $article) }}">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark-text-gray-100">

                            @foreach ($article->images as $image)
                            {{-- 特定のサイズのときは画像を小さく表示するなど、固定値ではない設定にする --}}
                                <img class="float-left rounded-3xl" src="{{ asset('/storage/' . $image->img_path) }}"
                                    style="width: 350px">
                            @endforeach

                            <p>{{ $article->shop_url }}</p>
                            <p>{{ $article->makeup_date }}</p>

                            {{-- 数字をもとに★の数を表示する。str_repeatで'文字列'を$の値分繰り返して表示する
                        <p>お気に入り{{ str_repeat('★', $article->favorite) }}</p>                         --}}
                            <div class="flex">
                                <p>お気に入り</p>
                                {{-- articleテーブルのfavoriteの回数（0以上max10以下）の★を繰り返し表示する --}}
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
                            {{-- flex：横並び　を設定して要素を横並びに。やらんと★が縦になる --}}
                            <div class="flex">
                                <p>自宅での再現率</p>
                                {{-- @dump(config('app.star_max')) --}}
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
                            
                            {{-- divを増やすことでimg下の空白が足される（カードを引っ付けたイメージ） --}}
                            {{-- <div class="p-6 sm:rounded-b-lg">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</x-app-layout>
