<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの新規作成') }}
        </h2>
    </x-slot>

    <div class="mx-4 sm:p-8">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <label for="price" class="font-semibold leading-none mt-4">価格（円）</label>
                <input type="number" id="price" name="menu[price]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.price', 1000) }}" min="0">
                <p class="name__error" style="color:red">{{ $errors->first('menu.price') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="count" class="font-semibold leading-none mt-4">回数（回）</label>
                <input type="number" id="count" name="menu[count]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.count', 1) }}" min="0">
                <p class="name__error" style="color:red">{{ $errors->first('menu.count') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <div class="flex items-center">
                    <label for="body" class="font-semibold leading-none mt-4">メモ</label>
                    <button type="button" id="aiGenerateButton" class="inline-flex items-center px-1 py-1 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2 ml-2">
                        自動入力
                    </button>
                </div>
                <textarea id="body" name="menu[body]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" cols="30" rows="10">{{old('menu.body')}}</textarea>{{--ここの文は改行すると、スマホ入力時に謎の空白ができてしまう。--}}
                <p class="name__error" style="color:red">{{ $errors->first('menu.body') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="image" class="font-semibold leading-none mt-4">画像（2MBまで）</label>
                <div>
                    <input id="image" type="file" name="menu[image_path]" accept="image/*">
                </div>
                <p class="name__error" style="color:red">{{ $errors->first('menu.image_path') }}</p>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4">
                保存する
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- axios -->
    <script>
        // ユーザーがした入力の処理
        document.getElementById('aiGenerateButton').addEventListener('click', function() {
            const sentence1 = document.getElementById('shop_name').value.trim(); // 最初の入力欄の値を取得
            const sentence2 = document.getElementById('name').value.trim(); // 2番目の入力欄の値を取得

            // 両方の入力が空白のみでないかをチェック
            if (!sentence1 && !sentence2) {
                alert("お店とメニューの名前を入力してください。");
                return;
            }

            // 入力を結合する場合（例: 両方の文章を一緒に送信）
            const combinedSentences = `${sentence1}の${sentence2}に関して、食べた後の感想を普通体でメモをしてください。400文字以内の制限。箇条書き。`;
            // console.log(combinedSentences);
            axios.post('/gemini', {
                sentence: combinedSentences,
                _token: '{{ csrf_token() }}'
            }).then(response => {
                // console.log(response.data.aiGeneratedDescription);
                // 「**」を削除し、「*」を「・」に置換
                const processedContent = response.data.aiGeneratedDescription
                    .replace(/\*\*/g, '') // 「**」を削除
                    .replace(/\*/g, '・'); // 「*」を「・」に置換

                // 既存のtextarea内容を取得し、新しいデータをその下に追加
                const bodyTextarea = document.getElementById('body');
                const currentText = bodyTextarea.value;

                // 新しい内容を追加（改行を加えて見やすくする）
                bodyTextarea.value = currentText + (currentText ? "\n" : "") + processedContent;
            }).catch(error => {
                console.error('AIによる説明の取得に失敗しました。', error);
            });
        });
    </script>

</x-app-layout>