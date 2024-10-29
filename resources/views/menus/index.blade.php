<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>グルメモ</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
        <a href='/menus/create'>add投稿</a>
        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif
        @endauth
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
</body>

</html>