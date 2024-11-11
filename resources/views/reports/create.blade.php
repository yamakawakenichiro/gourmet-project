<x-app-layout>
    <div class="content">
        <form action="{{ route('report.store', ['menu' => $menu->id]) }}" method="POST">
            @csrf
            <select name="report[category_id]">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="submit" onclick="reportComplete()" value="送信" />
        </form>
    </div>
    <div class="footer">
        <a href="{{route('show', ['menu' => $menu->id])}}">戻る</a>
    </div>

    <script>
        function reportComplete() {
            alert('報告が完了しました。');
        }
    </script>
</x-app-layout>