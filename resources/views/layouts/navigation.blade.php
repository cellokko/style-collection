<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('create')" :active="request()->routeIs('create')">
                        {{ _('新規投稿') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('latest')" :active="request()->routeIs('latest')">
                        {{ _('最新データ') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('favorite')" :active="request()->routeIs('favorite')">
                        {{ _('お気に入り') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('reproduction')" :activ="request()->routeIs('reproduction')">
                        {{ _('再現率') }}
                    </x-nav-link>
                </div>
                {{-- ユーザー名のプルダウンを参照してレングス別リンクをつくる（aタグはリンクできない） --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>レングス別</div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('hair_length', 'ベリーショート')">
                                {{ __('ベリーショート') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('hair_length', 'ショート')">
                                {{ __('ショート') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('hair_length', 'ボブ')">
                                {{ __('ボブ') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('hair_length', 'セミロング')">
                                {{ __('セミロング') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('hair_length', 'ロング')">
                                {{ __('ロング') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('hair_length', 'その他')">
                                {{ __('その他') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="hidden space-x-8 sm:my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('comments_count')" :activ="request()->routeIs('comments_count')">
                        {{ _('コメント数') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('search_word')" :activ="request()->routeIs('search_word')">
                        {{ _('検索') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown 画面右上のユーザーnameの設定-->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger　smなったときの三本線メニュー -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-nav-link :href="route('create')" :active="request()->routeIs('create')">
                {{ _('新規投稿') }}
            </x-nav-link><br>
            <x-nav-link :href="route('latest')" :active="request()->routeIs('latest')">
                {{ _('最新データ') }}
            </x-nav-link><br>
            <x-nav-link :href="route('favorite')" :active="request()->routeIs('favorite')">
                {{ _('お気に入り') }}
            </x-nav-link><br>
            <x-nav-link :href="route('reproduction')" :activ="request()->routeIs('reproduction')">
                {{ _('再現率') }}
            </x-nav-link><br>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center pt-2 pb-2 px-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>レングス別</div>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('hair_length', 'ベリーショート')">
                        {{ __('ベリーショート') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('hair_length', 'ショート')">
                        {{ __('ショート') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('hair_length', 'ボブ')">
                        {{ __('ボブ') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('hair_length', 'セミロング')">
                        {{ __('セミロング') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('hair_length', 'ロング')">
                        {{ __('ロング') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('hair_length', 'その他')">
                        {{ __('その他') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            <x-nav-link :href="route('comments_count')" :activ="request()->routeIs('comments_count')">
                {{ _('コメント数') }}
            </x-nav-link><br>
            <x-nav-link :href="route('search_word')" :activ="request()->routeIs('search_word')">
                {{ _('検索') }}
            </x-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
