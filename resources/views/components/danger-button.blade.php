<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

{{--delete-user-form.blade--}}

{{--
inline-flexなどのディスプレイスタイル
items-centerによるアイテムのセンタリング
px-4 py-2でパディングを設定
bg-red-600で背景色を設定
rounded-mdで角を丸める
font-semiboldでフォントの太さを設定
text-xsでフォントサイズを指定
text-whiteでテキストの色を設定
uppercaseでテキストを大文字に
tracking-widestで文字間隔を調整
hover:bg-red-500でホバー時の背景色変更
active:bg-red-700でアクティブ時の背景色変更
focus:outline-noneなどでフォーカスリングの制御
focus:ring-2 ...でフォーカス時のリングエフェクトを設定
transition ...でアニメーションのトランジションを設定
--}}