<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの一覧') }}
        </h2>
    </x-slot>
    <div id="map" style="width:400px; height:300px"></div>

    @if (!Auth::check() && Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ログイン</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">登録</a>
        @endif
    </div>
    @endif

    {{-- 検索機能ここから --}}
    <div>
        <form action="{{ route('index') }}" method="GET">
            <input type="text" name="keyword[name]" value="{{ $keywords['name'] ?? '' }}" placeholder="店名orメニュー名">
            <input type="number" name="keyword[count]" value="{{ $keywords['count'] ?? '' }}" placeholder="食べた回数" min="0">
            <input type="number" name="keyword[price_min]" value="{{ $keywords['price_min'] ?? '' }}" placeholder="最低価格" min="0">
            <input type="number" name="keyword[price_max]" value="{{ $keywords['price_max'] ?? '' }}" placeholder="最高価格" min="0">
            <input type="submit" value="検索">
        </form>
    </div>
    {{--検索機能ここまで--}}


    <div class='menus'>
        @foreach ($menus as $menu)
        <div class='menu'>
            <a href="/menus/{{ $menu->id }}">
                <p class='shop_name'>{{ $menu->shop_name }}</p>
                <p class='name'>{{ $menu->name }}</p>
                <p class='count'>{{ $menu->count }}</p>
            </a>
        </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $menus->links() }}
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap"></script>
</x-app-layout>