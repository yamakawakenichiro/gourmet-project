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
    <script>
        // 現在地取得処理
        function initMap() {
            // Geolocation APIに対応している
            if (navigator.geolocation) {
                // 現在地を取得
                navigator.geolocation.getCurrentPosition(
                    // 取得成功した場合
                    function(position) {
                        // 緯度・経度を変数に格納
                        var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        // var mapLatLng = new google.maps.LatLng(37.57, 126.97);//テスト（韓国のソウル）
                        // マップオプションを変数に格納
                        var mapOptions = {
                            zoom: 15, // 拡大倍率
                            center: mapLatLng // 緯度・経度
                        };
                        // マップオブジェクト作成
                        var map = new google.maps.Map(
                            document.getElementById("map"), // マップを表示する要素
                            mapOptions // マップオプション
                        );
                        //　マップにマーカーを表示する
                        var marker = new google.maps.Marker({
                            map: map, // 対象の地図オブジェクト
                            position: mapLatLng // 緯度・経度
                        });
                    },
                    // 取得失敗した場合
                    function(error) {
                        // エラーメッセージを表示
                        switch (error.code) {
                            case 1: // PERMISSION_DENIED
                                alert("位置情報の利用が許可されていません");
                                break;
                            case 2: // POSITION_UNAVAILABLE
                                alert("現在位置が取得できませんでした");
                                break;
                            case 3: // TIMEOUT
                                alert("タイムアウトになりました");
                                break;
                            default:
                                alert("その他のエラー(エラーコード:" + error.code + ")");
                                break;
                        }
                    }
                );
                // Geolocation APIに対応していない
            } else {
                alert("この端末では位置情報が取得できません");
            }
        }
    </script>
</head>

<body>
    <div id="map" style="width:400px; height:300px"></div>

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
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap"></script>
</body>

</html>