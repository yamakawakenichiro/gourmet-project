<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>グルメモ</title>
</head>

<body>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <p>画像をアップロードしますか？</p>
            <input type="file" name="menu[image_path]" accept="image/*">
        </div>
        <div class="shop_name">
            <p>お店の名前はなんですか？</p>
            <textarea name="menu[shop_name]"> {{ old('menu.shop_name') }}</textarea>
            <p class="shop_name__error" style="color:red">{{ $errors->first('menu.shop_name') }}</p>
        </div>
        <div class="name">
            <p>メニューの名前はなんですか？</p>
            <textarea name="menu[name]"> {{ old('menu.name') }}</textarea>
            <p class=" name__error" style="color:red">{{ $errors->first('menu.name') }}</p>
        </div>
        <div class="price">
            <p>価格はいくらですか？</p>
            <input type="number" name="menu[price]" value="{{ old('menu.price') }}" />
        </div>
        <div class="count">
            <p>何回目ですか？</p>
            <input type="number" name="menu[count]" value="{{ old('menu.count') }}" />
        </div>
        <div class="body">
            <p>メモ欄</p>
            <textarea name="menu[body]"> {{ old('menu.body') }}</textarea>
        </div>
        <input type="submit" value="保存" />
    </form>
    <div class="footer">
        <a href="{{ route('index') }}">戻る</a>
    </div>
</body>

</html>