<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/images/hamburger_1.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    {{--FontsはCDN。viteのapp.cssにまとめない方がいいらしい。読み込みに時間がかかり時崩れの可能性があるため。--}}

    <!-- Scripts -->
    @vite([
    'resources/css/app.css',
    'resources/css/pagination.css',
    'resources/js/app.js',
    ])
    <script>
        function initMap() {
            // Geolocation APIに対応している
            if (navigator.geolocation) {
                // 現在地を取得
                navigator.geolocation.getCurrentPosition( //navigator.geolocation.getCurrentPositionメソッドを実行すること自体が、ユーザーから位置情報の許可を取得するトリガーになります。
                    // 取得成功した場合
                    function(position) {
                        console.log("位置情報の取得に成功しました", position); // コンソールに成功した緯度・経度を出力
                        console.log("現在地の緯度: " + position.coords.latitude + " 経度: " + position.coords.longitude);
                        // 緯度・経度を変数に格納
                        var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        // var mapLatLng = new google.maps.LatLng(37.57, 126.97); //テスト（韓国のソウル）
                        console.log(mapLatLng);
                        // マップオプションを変数に格納
                        var mapOptions = {
                            zoom: 13, // 拡大倍率
                            center: mapLatLng // 緯度・経度
                        };
                        // マップオブジェクト作成
                        var map = new google.maps.Map(
                            document.getElementById("map"), // マップを表示する要素
                            mapOptions // マップオプション
                        );
                        // マップにマーカーを表示する
                        var marker = new google.maps.Marker({
                            map: map, // 対象の地図オブジェクト
                            position: mapLatLng // 緯度・経度
                        });
                    },
                    // 取得失敗した場合
                    function(error) {
                        console.error("位置情報の取得に失敗しました", error); // コンソールにエラー情報を出力
                        // エラーメッセージを表示
                        switch (error.code) {
                            case 1: // PERMISSION_DENIED
                                alert("位置情報の利用が許可されていません");
                                break;
                            case 2: // POSITION_UNAVAILABLE HTTPSで接続が必要なブラウザでHTTPで接続した場合などに返される
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

<body class="font-sans antialiased min-h-screen bg-gray-100"">
    @include('layouts.navigation')
    <!-- Page Heading -->
    <header class=" bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マップ') }}
        </h2>

        @if (session('message'))
        <div class="alert alert-success border px-4 py-3 rounded relative bg-green-100 border-green-400 text-green-700">
            {{ session('message') }}
        </div>
        @endif
    </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="p-2 sm:p-8">
                <div class="flex items-center justify-center overflow-hidden bg-white w-full rounded-2xl shadow-lg ">
                    <div id="map" class="w-full h-full rounded-2xl" style="width:2000px; height:450px"></div>
                </div>
            </div>
            {{--callbackはGoogle Mapsのスクリプトが読み込まれたら、initMapを呼び出し--}}
            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap"></script>

        </div>
    </main>
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <hr class="mt-2 border-gray-300 rounded">
        <footer class="flex justify-center">
            <p class="my-3 text-gray-900 text-sm">&copy; 2024 Yamakawa</p>
        </footer>
    </div>
</body>

</html>