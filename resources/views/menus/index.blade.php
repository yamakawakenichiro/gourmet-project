<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>サービス名</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <!-- <h1>サービス名</h1> -->
    <div class='menus'>
        @foreach ($menus as $menu)
        <div class='menu'>
            <h2 class='shop_id'>shop_id:{{ $menu->shop_id }}</h2>
            <p class='name'>{{ $menu->name }}</p>
            <p class='count'>{{ $menu->count }}</p>
        </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $menus->links() }}
    </div>
</body>

</html>