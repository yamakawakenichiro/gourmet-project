<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メモの編集') }}
        </h2>
    </x-slot>
    <div class="content">
        <form action="{{ route('show', ['menu' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="md:flex items-center mt-8">
                <div class="w-full flex flex-col">
                    <label for="shop_name" class="font-semibold leading-none mt-4">お店の名前</label>
                    <input type="text" id="shop_name" name="menu[shop_name]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ $menu->shop_name }}">
                    <p class="shop_name__error" style="color:red">{{ $errors->first('menu.shop_name') }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col">
                <label for="name" class="font-semibold leading-none mt-4">メニューの名前</label>
                <input type="text" id="name" name="menu[name]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ $menu->name }}">
                <p class="name__error" style="color:red">{{ $errors->first('menu.name') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="price" class="font-semibold leading-none mt-4">価格（円）</label>
                <input type="number" id="price" name="menu[price]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ $menu->price }}">
                <p class="name__error" style="color:red">{{ $errors->first('menu.price') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="count" class="font-semibold leading-none mt-4">回数（回）※±１のみ変更可能</label>
                @php
                $minCount = $menu->count - 1;
                $maxCount = $menu->count + 1;
                @endphp
                <input type="number" id="count" name="menu[count]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ $menu->count }}" min="{{ $minCount }}" max="{{ $maxCount }}" step="1">
                <p class="name__error" style="color:red">{{ $errors->first('menu.count') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold leading-none mt-4">メモ</label>
                <textarea name="menu[body]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('menu.body', $menu->body)}}</textarea>
                <p class="name__error" style="color:red">{{ $errors->first('menu.body') }}</p>
            </div>
            <div class="w-full flex flex-col">
                <label for="image" class="font-semibold leading-none mt-4">画像（4MBまで）</label>
                <div>
                    <input id="image" type="file" name="menu[image_path]" accept="image/*">
                </div>
                <p class="name__error" style="color:red">{{ $errors->first('menu.image_path') }}</p>
                <!-- 画像表示 -->
                @if ($menu->image_path)
                <p>画像を削除しますか？ <input type="checkbox" name="delete_image" value="true"></p>
                <img src="{{ $menu->image_path }}" alt="Menu Image" class="mx-auto" style="max-width: 100%; height: 150px;">
                @else
                <p>No image</p>
                @endif
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4">
                更新する
            </button>

        </form>
    </div>
</x-app-layout>