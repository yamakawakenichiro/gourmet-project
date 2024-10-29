<!DOCTYPE html>
<html lang="ja">

<head>
    <title>報告メール</title>
</head>

<body>
    <p>新しい報告があります</p>
    <ul>
        <li>報告者: {{ $reporter }}</li>
        <li>投稿者: {{ $userName }}</li>
        <li>メニューID: {{ $report->menu_id }}</li>
        <li>カテゴリ名: {{ $categoryName }}</li>
        <li>作成日時: {{ $created_at ? $created_at->format('Y-m-d H:i:s') : '不明' }}</li>
    </ul>
</body>

</html>