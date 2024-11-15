<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}さんの{{ __('フォロー中・フォロワー') }}
        </h2>
    </x-slot>

    {{-- フォロー/アンフォロー一覧 --}}
    <div class="mx-4 sm:p-8">
        <div class="mt-4">
            <div class="bg-white w-full rounded-2xl px-10 pb-8 shadow-lg hover:shadow-2sl transition duration-500">
                <div class="mt-4">

                    <div class="flex">
                        <h1 class="text-lg text-gray-700 font-semibold float-left pt-4">
                            フォロー中
                        </h1>
                    </div>
                    <hr class="w-full">

                    {{-- 自分自身を除いたフォロー中・フォロワーのユーザーを取得 --}}
                    @php
                    $filteredFollowings = $user->followings->filter(fn($following) => $following->id !== $user->id);
                    $filteredFollowers = $user->followers->filter(fn($follower) => $follower->id !== $user->id);
                    @endphp
                    <ul>
                        @if ($filteredFollowings->isEmpty())
                        <li class="mt-2 text-gray-600 py-2">あなたが、フォローしている人はいません。</li>
                        @else
                        @foreach ($filteredFollowings as $following)
                        <li class="mt-2 text-gray-600">
                            <a href="{{ route('user.index', ['user' => $following->id]) }}" class="hover:underline cursor-pointer">
                                {{ $following->name }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>

                    <div class="flex">
                        <h1 class="text-lg text-gray-700 font-semibold float-left pt-4">
                            フォロワー
                        </h1>
                    </div>
                    <hr class="w-full">
                    <ul>
                        @if ($filteredFollowers->isEmpty())
                        <li class="mt-2 text-gray-600 py-2">あなたを、フォローしている人はいません。</li>
                        @else
                        @foreach ($filteredFollowers as $follower)
                        <li class="mt-2 text-gray-600">
                            <a href="{{ route('user.index', ['user' => $follower->id]) }}" class="hover:underline cursor-pointer">
                                {{ $follower->name }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>