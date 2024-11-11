@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{--navigation.blade--}}

{{--
アクティブな時（$active ?? falseがtrueの時）:
?
border-b-2 border-indigo-400: 下部にインディゴ色のボーダーを2px描画し、アクティブ状態を視覚的に示します。
text-gray-900: テキストカラーを濃いグレー（ほぼ黒）に設定します。
非アクティブな時（それ以外の場合）:
:
border-b-2 border-transparent: ボーダーを2pxとしつつ、透明にして視覚的なボーダーを見えないようにします。
text-gray-500: テキストカラーを中程度のグレーに設定します。
hover:text-gray-700 hover:border-gray-300: ホバー時にテキストを少し濃いグレー、ボーダーをグレーに変更することで、インタラクティブなフィードバックを提供します。

ナビゲーションバーのリンクとして、現在のページがどのリンクに対応するかをユーザーに視覚的に示すために使います。
--}}