@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
case 'left':
$alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
break;
case 'top':
$alignmentClasses = 'origin-top';
break;
case 'right':
default:
$alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
break;
}

switch ($width) {
case '48':
$width = 'w-48';
break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
        style="display: none;"
        @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

{{--navigation.blade--}}

{{--
alignmentClassesは、コンポーネントのアラインメントを制御するためのクラスです。ltrとrtlは、左から右と右から左のテキスト方向に応じて適用されるクラスを示しています。
@click.outside="open = false"で、ドロップダウン外をクリックすると閉じる
@close.stopイベントハンドラが中で処理された後、他の親要素がそのイベントを受け取らないようにしたい場合に使用
x-transition:enterとx-transition:leaveで表示と非表示の際のアニメーションを設定
@click="open = ! open"「トグル(toggle)」は、状態をスイッチのように切り替えることを意味します。
--}}