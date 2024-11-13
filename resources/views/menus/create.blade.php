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
            <div class="md:flex items-center mt-8">
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
                <input type="number" id="price" name="menu[price]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.price') }}">
            </div>
            <div class="w-full flex flex-col">
                <label for="count" class="font-semibold leading-none mt-4">回数</label>
                <input type="number" id="count" name="menu[count]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" value="{{ old('menu.count') }}">
            </div>
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold leading-none mt-4">メモ</label>
                <textarea name="menu[body]" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10"> {{ old('menu.body') }}</textarea>
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
</x-app-layout>