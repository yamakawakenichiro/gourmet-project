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
    <!-- ログインユーザーかつ、自分の投稿詳細のみ編集・削除ボタンを表示 -->
    @if (Auth::id() === $menu->user_id)
    <div class="edit"><a href='/menus/{{ $menu->id }}/edit'>編集</a></div>
    <form action="/menus/{{ $menu->id }}" id="form_{{ $menu->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deleteMenu({{ $menu->id }})">削除</button>
    </form>
    @endif

    <div class="image">
        <p>画像をアップロードしますか？</p>
        <img src="{{ $menu->image }}" alt="Menu画像">
    </div>
    <div class="shop_name">
        <p>お店の名前はなんですか？</p>
        <p>{{ $menu->shop_name }}</p>
    </div>
    <div class="name">
        <p>メニューの名前はなんですか？</p>
        <p>{{ $menu->name }}</p>
    </div>
    <div class="price">
        <p>価格はいくらですか？</p>
        <p>{{ $menu->price }}</p>
    </div>
    <div class="count">
        <p>何回目ですか？</p>
        <p>{{ $menu->count }}</p>
    </div>
    <div class="body">
        <p>コメント欄</p>
        <p>{{ $menu->body }}</p>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>

    <script>
        function deleteMenu(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>

</html>