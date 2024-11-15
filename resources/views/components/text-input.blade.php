@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>

{{--
disabled というプロパティを定義しており、デフォルトでは false に設定されています。
disabled は、HTMLフォーム要素の属性であり、入力フィールドやボタンを無効化するために使われます。

border-gray-300: 入力フィールドのボーダー色を薄いグレーに設定。
focus:border-indigo-500: 入力フィールドがフォーカスされたときのボーダー色をインディゴ(藍色)に設定。
focus:ring-indigo-500: フォーカス時のリング（アウトライン）色をインディゴに設定。
rounded-md: 入力フィールドの角を中程度に丸めるスタイル。
shadow-sm: 小さなシャドウを追加して立体的に見せるスタイル。
--}}