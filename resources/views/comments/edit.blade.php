<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'ユーザーコメント編集' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark-text-gray-100">
                    <div class="py-3">
                        <div class="bg-white shadow-sm border rounded-md border-white">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">編集するコメント
                            </h2>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <p class="text-xl">{{ $comment->content }}</p>
                        <label class="text-sm">{{ $comment->created_at }} {{ $comment->user->name }}</label>
                    </div><br>
                    @auth
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <form method="POST" action="{{ route('comments.edit', ['comment' => $comment]) }}">
                                @csrf
                                <p class="text-2xl">コメント内容</p>
                                @error('content')
                                    <strong>コメント内容を入力してください</strong>
                                @enderror
                                <textarea name="content">{{ old('content', $comment->content) }}</textarea><br><br>
                                {{-- <input type="hidden" name="article_id" value="{{ $article->id }}"> --}}

                                <button type="submit"
                                    class="px-6 py-2 flex item-center justify-center rounded-md bg-black text-white">更新</button><br>
                            </form>

                            <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="px-6 py-2 flex item-center justify-center rounded-md border border-gray-300 bg-gray-300">このコメントを削除する
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
