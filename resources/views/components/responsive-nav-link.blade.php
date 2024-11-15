@props(['active'])

@php
$classes = ($active ?? false)
? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
: 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{--navigation.blade--}}

{{--
アクティブな場合:
border-l-4 border-indigo-400: 左側にインディゴカラーの太いボーダーを設定し、アクティブなリンクを視覚的に強調。
text-indigo-700 bg-indigo-50: テキスト色をインディゴ、背景色を淡いインディゴに設定して差別化。
focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700: フォーカス時のスタイリングを設定。

非アクティブな場合:
border-l-4 border-transparent: ボーダーを設定しているが透明にして非表示。
text-gray-600: テキスト色をグレーに設定。
hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300: ホバー時にテキスト色と背景色、ボーダー色を変更しインタラクションを提供。
focus系のクラスにより、フォーカス時のスタイリングが設定されている。

ナビゲーションバーのリンクとして、現在のページがどのリンクに対応するかをユーザーに視覚的に示すために使います。
--}}