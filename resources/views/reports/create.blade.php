<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの違反報告') }}
        </h2>
    </x-slot>
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

    <script>
        function reportComplete() {
            alert('報告が完了しました。');
        }
    </script>
</x-app-layout>