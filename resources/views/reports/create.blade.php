<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの違反報告') }}
        </h2>
    </x-slot>
    <div class="content mx-4 sm:p-8">
        <form action="{{ route('report.store', ['menu' => $menu->id]) }}" method="POST">
            <div class="flex items-center justify-center mt-8">
                @csrf
                <select name="report[category_id]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="submit" onclick="reportComplete()" value="送信" class="inline-flex items-center ml-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" />
        </form>
    </div>
    </div>

    <script>
        function reportComplete() {
            alert('報告が完了しました。');
        }
    </script>
</x-app-layout>