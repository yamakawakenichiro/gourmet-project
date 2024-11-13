<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}さんの{{ __('フォロー・フォロワー') }}
        </h2>
    </x-slot>

    <!-- フォロー/アンフォロー一覧 -->
    <div class="mx-4 sm:p-8">
        <div class="mt-4">
            <div class="bg-white w-full rounded-2xl px-10 pb-8 shadow-lg hover:shadow-2sl transition duration-500">
                <div class="mt-4">

                    <div class="flex">
                        <h1 class="text-lg text-gray-700 font-semibold float-left pt-4">
                            フォロー
                        </h1>
                    </div>
                    <hr class="w-full">
                    <ul>
                        @if ($user->followings->count() > 0)
                        @foreach ($user->followings as $following)
                        <li class="mt-2 text-gray-600 py-2">
                            <a href="{{ route('user.index', ['userId' => $following->id]) }}" class="hover:underline cursor-pointer">
                                {{ $following->name }}
                            </a>
                        </li>
                        @endforeach
                        @else
                        <li class="mt-2 text-gray-600 py-2">あなたが、フォローしている人はいません。</li>
                        @endif
                    </ul>

                    <div class="flex">
                        <h1 class="text-lg text-gray-700 font-semibold float-left pt-4">
                            フォロワー
                        </h1>
                    </div>
                    <hr class="w-full">
                    <ul>
                        @if ($user->followers->count() > 0)
                        @foreach ($user->followers as $follower)
                        <li class="mt-2 text-gray-600 py-2">
                            <a href="{{ route('user.index', ['userId' => $follower->id]) }}" class="hover:underline cursor-pointer">
                                {{ $follower->name }}
                            </a>
                        </li>
                        @endforeach
                        @else
                        <li class="mt-2 text-gray-600 py-2">あなたを、フォローしている人はいません。</li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>