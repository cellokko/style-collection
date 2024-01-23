<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ '最新データ' }}
        </h2>
    </x-slot>
    {{-- Dashboard画面に既存しているレイアウトを流用してカードを作る
        35行目から同じものを2つつくり、画面の表示の感覚を見る --}}
    @foreach ($articles as $article)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-t-lg">
                    <div class="p-6 text-gray-900 dark-text-gray-100">
                        {{-- float（浮かせる）でimgをどこに置くか指定する。今回は左側にimg、右側にline oneを配置。
                        sm:rounded-t-lg = 画面サイズがsm以上のとき、枠をlgサイズで丸くする。
                        srcでとぶのはサンプル画面サイト。URL末尾400はimgサイズ（任意） --}}
                        <img class="float-left rounded-3xl" src="{{ asset('img/400') }}">
                        <p>{{ $article->makeup_date }}</p>
                        <p>{{ $article->report }}</p>
                        <p>{{ $article->favorite }} ★★★★</p>
                    </div>
                </div>
                {{-- 改めてdivを記述しclassを設定することで、imgの下にカードが作られる（これをしないと白枠の欄外になる）
                画面上では1つの白枠に見えるが、実は2つ連結している。四方の角を丸くするため、下段白枠のbottomのみroundedする --}}
                {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>line three</p>
                        <p>line four</p>
                    </div>
                </div> --}}
            </div>
        </div>
    @endforeach

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- class="float-left"を省略するとimg下にlineが配置される（float-noneと同じ） --}}
                    <img src="https://i.pravatar.cc/400">
                    <p>line one</p>
                    <p>line two</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
