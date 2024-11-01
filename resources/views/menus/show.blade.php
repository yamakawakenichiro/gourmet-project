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
    {{ $menu->user->name }}
    @auth

    <!-- 自分の投稿の場合は編集・削除ボタンを表示 -->
    @if ($menu->user_id === auth()->id())
    <div class="edit"><a href='/menus/{{ $menu->id }}/edit'>編集</a></div>
    <form action="/menus/{{ $menu->id }}" id="form_{{ $menu->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deleteMenu('{{ $menu->id }}')">削除</button>
    </form>
    @else
    <!-- 他人の投稿 -->
    <!-- フォロー/アンフォローボタン -->
    @php
    $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
    @endphp
    <form action="{{ route($isFollowing ? 'unfollow' : 'follow', $user) }}" method="POST">
        @csrf
        <button type="submit">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>
    </form>
    <!-- 報告ボタン -->
    <div class="report"><a href='/menus/{{ $menu->id }}/report'>報告</a></div>
    @endif

    <!-- いいね機能 -->
    @if (Auth::user()->is_like($menu->id))
    <form action="{{ route('like.delete', $menu->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="button btn btn-warning">いいね！を外す</button>
    </form>
    @else
    <form action="{{ route('like.store', $menu->id) }}" method="POST">
        @csrf
        <button type="submit" class="button btn btn-success">いいね！を付ける</button>
    </form>
    @endif
    <div class="text-right mb-2">いいね！
        <span class="badge badge-pill badge-success">{{ $like }}</span>
    </div>

    @endauth

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
        <p>メモ欄</p>
        <p>{{ $menu->body }}</p>
    </div>
    <div class="footer">
        <a href="{{ route('index') }}">戻る</a>
    </div>

    <!-- コメント-->
    <h2>Comments</h2>

    @foreach($menu->comments as $comment)
    <div class="comment">
        <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->diffForHumans() }}):
        <p>{{ $comment->content }}</p>
    </div>
    @endforeach

    @if(auth()->check())
    <form method="POST" action="{{ route('comments.store', $menu->id) }}">
        @csrf
        <textarea name="content" placeholder="コメントを入力してください"></textarea>
        <button type="submit">コメントを送信</button>
    </form>
    @else
    <p>コメントを残すにはログインしてください。</p>
    @endif

    <!-- 操作完了メッセージ-->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

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