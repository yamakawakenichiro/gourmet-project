<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの詳細') }}
        </h2>
    </x-slot>

    <div class="mx-4 sm:p-8">
        <div class="mt-4">
            <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="mt-4">
                    <div class="flex flex-col">
                        <div class="text-lg text-gray-700 font-semibold float-left pt-4">
                            {{ $menu->shop_name }}
                        </div>
                        <div class="text-lg text-gray-700 font-semibold float-left pt-2">
                            {{ $menu->name }}({{ $menu->price }}円 {{ $menu->count }}回目)
                        </div>
                    </div>
                    <hr class="w-full">
                </div>

                @auth
                {{-- 自分の投稿の場合は編集・削除ボタンを表示 --}}
                @if ($menu->user_id === auth()->id())
                <div class="flex justify-end mt-4">
                    <a href='/menus/{{ $menu->id }}/edit'>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 bg-teal-700 float-right">
                            編集
                        </button>
                    </a>
                    <form action="/menus/{{ $menu->id }}" id="form_{{ $menu->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs 
                        text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 
                        disabled:opacity-25 transition ease-in-out duration-150 bg-red-700 float-right ml-4" onclick="deleteMenu('{{ $menu->id }}')">
                            削除
                        </button>
                    </form>
                </div>
                @endif
                <div class="flex items-center justify-end mt-2">
                    {{-- いいね機能 --}}
                    @if (Auth::user()->is_like($menu->id))
                    <form action="{{ route('like.delete', $menu->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button btn btn-warning bg-red-500 hover:bg-red-700 text-white font-semibold text-xs py-2 px-4 rounded-md">いいね！を外す</button>
                    </form>
                    @else
                    <form action="{{ route('like.store', $menu->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="button btn btn-success bg-blue-500 hover:bg-blue-700 text-white font-semibold text-xs py-2 px-4 rounded-md">いいね！を付ける</button>
                    </form>
                    @endif
                    <div class="text-center">
                        <span class="badge badge-pill badge-success ml-2 font-semibold text-xs">{{ $menu->like_users_count }}</span>
                    </div>
                </div>
                @endauth

                <div>
                    <p class="text-gray-600 py-4 whitespace-pre-wrap">{!! nl2br(e($menu->body)) !!}</p>
                    <div>
                        @if ($menu->image_path)
                        <img src="{{ $menu->image_path }}" alt="Menu Image" class="mx-auto" style="max-width: 100%; height: 150px;">
                        @endif
                    </div>
                    <div class="text-sm font-semibold flex flex-row-reverse mt-2">
                        <p>{{ $menu->user->name }}・{{ $menu->created_at->diffForHumans() }}</p>
                    </div>

                    @if ($menu->user_id !== auth()->id())
                    <div class="text-sm font-semibold flex flex-row-reverse mt-2">
                        @php
                        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
                        @endphp
                        <form action="{{ route($isFollowing ? 'unfollow' : 'follow', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $isFollowing ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-semibold text-xs py-2 px-4 rounded">
                                {{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>
                        </form>
                    </div>
                    <hr class="w-full mt-2">
                    <div class="text-sm font-semibold flex flex-row-reverse mt-2">
                        {{-- 報告ボタン --}}
                        <div class="report"><a href='/menus/{{ $menu->id }}/report'>報告</a></div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- コメント--}}
            @foreach($menu->comments as $comment)
            <div class="comment bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-4">
                <p>{{ $comment->content }}</p>
                <div class="text-sm font-semibold flex flex-row-reverse">
                    <p class="float-left pt-4">
                        {{ $comment->user->name }} ({{ $comment->created_at->diffForHumans() }})
                    </p>
                </div>
            </div>
            @endforeach

            {{-- 操作完了メッセージ--}}
            @if(session('success'))
            <div class="text-sm flex justify-center">
                <div class="alert alert-success pt-4">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if(auth()->check())
            <form method="POST" action="{{ route('comments.store', $menu->id) }}">
                @csrf
                <textarea name="content" class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" placeholder="コメントを入力してください"></textarea>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold 
                text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 
                focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 float-right mr-4 mb-12">コメントする</button>
            </form>
            @else
            <div class="bg-white w-full rounded-2xl px-10 py-4 shadow-lg hover:shadow-2xl transition duration-500 mt-4">
                <p>コメントを残すにはログインしてください。</p>
            </div>
            @endif

        </div>
    </div>

    <script>
        function deleteMenu(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>