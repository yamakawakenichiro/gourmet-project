<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの一覧') }}
        </h2>
    </x-slot>

    {{-- 検索機能 --}}
    <div class="mt-6 mx-4">
        <form class="max-w-md mx-auto" action="{{ route('index') }}" method="GET">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="keyword[name]" value="{{ $keywords['name'] ?? '' }}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="店名orメニュー名" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">検索</button>
            </div>
        </form>
    </div>

    {{-- 検索機能未使用
    <div>
        <form action="{{ route('index') }}" method="GET">
    <input type="text" name="keyword[name]" value="{{ $keywords['name'] ?? '' }}" placeholder="店名orメニュー名">
    <input type="number" name="keyword[count]" value="{{ $keywords['count'] ?? '' }}" placeholder="食べた回数" min="0">
    <input type="number" name="keyword[price_min]" value="{{ $keywords['price_min'] ?? '' }}" placeholder="最低価格" min="0">
    <input type="number" name="keyword[price_max]" value="{{ $keywords['price_max'] ?? '' }}" placeholder="最高価格" min="0">
    <input type="submit" value="検索">
    </form>
    </div>
    --}}

    <div class='menus'>
        @foreach ($menus as $menu)
        <div class="menu mx-4 sm:p-8">
            <div class="mt-4">
                <a href="/menus/{{ $menu->id }}">
                    <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl cursor-pointer transition duration-500">
                        <div class="mt-4">
                            <div class="flex">
                                <div class="flex flex-col">
                                    <h1 class="text-lg text-gray-700 font-semibold float-left">
                                        {{ $menu->shop_name }}
                                    </h1>
                                    <h1 class="text-lg text-gray-700 font-semibold float-left">
                                        {{ $menu->name }} ({{ $menu->price }}円 {{ $menu->count }}回目)
                                    </h1>
                                </div>
                            </div>
                            <hr class="w-full">

                            @if ($menu->image_path)
                            <div class="rounded-md overflow-hidden w-12 h-12 mt-4">
                                <img class="object-cover w-full h-full" src="{{ $menu->image_path }}" alt="Menu Image">
                            </div>
                            @endif

                            <p class="text-gray-600 py-4 whitespace-pre-wrap">{!! nl2br(e($menu->body)) !!}</p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $menu->user->name }}・{{ $menu->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class='paginate flex items-center justify-center mt-4'>
        {{ $menus->links() }}
    </div>

</x-app-layout>