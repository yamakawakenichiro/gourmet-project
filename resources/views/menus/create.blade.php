<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの新規作成') }}
        </h2>
    </x-slot>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="mx-4 sm:p-8">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" id="aiGenerateButton" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4">
                自動生成
            </button>
            <div class="md:flex items-center mt-6">
                <div class="w-full flex flex-col">
                    <label for="shop_name" class="font-semibold leading-none mt-4">お店の名前</label>
                    <input type="text" id="shop_name" name="menu[shop_name]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.shop_name') }}">
                    <p class="shop_name__error" style="color:red">{{ $errors->first('menu.shop_name') }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col">
                <label for="name" class="font-semibold leading-none mt-4">メニューの名前</label>
                <input type="text" id="name" name="menu[name]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.name') }}">
                <p class="name__error" style="color:red">{{ $errors->first('menu.name') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="price" class="font-semibold leading-none mt-4">価格</label>
                <input type="number" id="price" name="menu[price]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.price') }}" min="0">
                <p class="name__error" style="color:red">{{ $errors->first('menu.price') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="count" class="font-semibold leading-none mt-4">回数</label>
                <input type="number" id="count" name="menu[count]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.count') }}" min="0">
                <p class="name__error" style="color:red">{{ $errors->first('menu.count') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold leading-none mt-4">メモ</label>
                <textarea name="menu[body]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('menu.body')}}</textarea>{{--ここの文は改行すると、スマホ入力時に謎の空白ができてしまう。--}}
            </div>
            <div class="w-full flex flex-col">
                <label for="image" class="font-semibold leading-none mt-4">画像（1MBまで）</label>
                <div>
                    <input id="image" type="file" name="menu[image_path]" accept="image/*">
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4">
                送信する
            </button>
        </form>
    </div>

    <!-- ユーザー入力部分 -->
    <textarea id="userInput" placeholder="ここに文を入力してください"></textarea>

    <div id="aiDescription">
        <!-- AIの説明がここに挿入されます -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- axios -->
    <script>
        // ユーザーがした入力の処理
        document.getElementById('aiGenerateButton').addEventListener('click', function() {
            const sentence = document.getElementById('userInput').value.trim(); // トリムして空白のみの入力を防ぐ
            // 空欄アラート
            if (!sentence) {
                alert("入力欄に文章を入力してください。"); // 入力が空の場合は警告を表示
                return; // 処理を中断
            }
            // ルート
            axios.post('/gemini', {
                sentence: sentence,
                _token: '{{ csrf_token() }}'
            }).then(response => {
                document.getElementById('body').innerText = response.data.aiGeneratedDescription;
            }).catch(error => {
                console.error('AIによる説明の取得に失敗しました。', error);
            });
        });
    </script>

</x-app-layout>