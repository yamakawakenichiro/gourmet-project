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
        <form action="{{ route('report.store', ['menu' => $menu->id]) }}" method="POST">
            @csrf
            <select name="report[category_id]">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="submit" value="送信" />
        </form>
    </div>
    <div class="footer">
        <a href="{{route('show', ['menu' => $menu->id])}}">戻る</a>
    </div>
</body>

</html>