<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>グルメモ</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <div class="content">
        <form action="{{ route('show', ['menu' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="image">
                <!-- 画像入力 -->
                <p>画像をアップロードしますか？</p>
                <input type="file" name="menu[image_path]" accept="image/*">
                <!-- 画像表示 -->
                @if ($menu->image_path)
                <img src="{{ $menu->image_path }}" alt="Menu Image" style="max-width: 100%; height: auto;">
                @else
                <p>No image available</p>
                @endif
            </div>
            <div class="shop_name">
                <p>お店の名前はなんですか？</p>
                <textarea name="menu[shop_name]"> {{ $menu->shop_name }}</textarea>
                <p class="shop_name__error" style="color:red">{{ $errors->first('menu.shop_name') }}</p>
            </div>
            <div class="name">
                <p>メニューの名前はなんですか？</p>
                <textarea name="menu[name]"> {{ $menu->name }}</textarea>
                <p class=" name__error" style="color:red">{{ $errors->first('menu.name') }}</p>
            </div>
            <div class="price">
                <p>価格はいくらですか？</p>
                <input type="number" name="menu[price]" value="{{ $menu->price }}" />
            </div>
            <div class="count">
                <p>何回目ですか？</p>
                <input type="number" name="menu[count]" value="{{ $menu->count }}" />
            </div>
            <div class="body">
                <p>コメント欄</p>
                <textarea name="menu[body]"> {{ $menu->body }}</textarea>
            </div>
            <input type="submit" value="更新" />
        </form>
        <div class="footer">
            <a href="{{route('show', ['menu' => $menu->id])}}">戻る</a>
        </div>
    </div>
</body>

</html>