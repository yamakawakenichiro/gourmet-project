<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('いいねしたメモ') }}
        </h2>
    </x-slot>

    <div class='menus'>
        @foreach ($menus as $menu)
        <div class="menu mx-4 sm:p-8">
            <div class="mt-4">
                <a href="/menus/{{ $menu->id }}">
                    <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <div class="flex">
                                <div class="flex flex-col">
                                    <h1 class="text-lg text-gray-700 font-semibold float-left">
                                        {{ $menu->shop_name }}
                                    </h1>
                                    <h1 class="text-lg text-gray-700 font-semibold float-left">
                                        {{ $menu->name }} ({{ $menu->price }}円 {{ $menu->count }}回目)
                                    </h1>
                                </div>
                            </div>
                            <hr class="w-full">

                            @if ($menu->image_path)
                            <div class="rounded-md overflow-hidden w-12 h-12 mt-4">
                                <img class="object-cover w-full h-full" src="{{ $menu->image_path }}" alt="Menu Image">
                            </div>
                            @endif

                            <p class="text-gray-600 py-4 whitespace-pre-wrap">{!! nl2br(e($menu->body)) !!}</p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $menu->user->name }}・{{ $menu->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class='paginate flex items-center justify-center mt-4'>
        {{ $menus->links() }}
    </div>

</x-app-layout>