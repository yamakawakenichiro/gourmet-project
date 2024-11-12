<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div id="map" style="width:400px; height:300px"></div>

    <!-- フォロー/アンフォロー一覧 -->
    @php
    $user = Auth::user();
    @endphp

    <h2>Following</h2>
    <ul>
        @foreach ($user->followings as $following)
        <li>{{ $following->name }}</li>
        @endforeach
    </ul>

    <h2>Followers</h2>
    <ul>
        @foreach ($user->followers as $follower)
        <li>{{ $follower->name }}</li>
        @endforeach
    </ul>


    <!-- ユーザー入力部分 -->
    <textarea id="userInput" placeholder="ここに文を入力してください"></textarea>
    <button type="button" id="aiGenerateButton">AIによる応答</button>

    <div id="aiDescription">
        <!-- AIの説明がここに挿入されます -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- axios -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap"></script>
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
                document.getElementById('aiDescription').innerText = response.data.aiGeneratedDescription;
            }).catch(error => {
                console.error('AIによる説明の取得に失敗しました。', error);
            });
        });
    </script>
</x-app-layout>