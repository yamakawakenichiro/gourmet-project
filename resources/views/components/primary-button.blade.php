<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>


{{--
inline-flex items-center: ボタン内のコンテンツをインラインフレックスボックスレイアウトで表示し、中心に揃える。
px-4 py-2: 水平方向に4px、垂直方向に2pxのパディングを設定。
bg-gray-800: 初期状態での背景色を、濃いグレーに設定。
border border-transparent: ボーダーを設定はするが、透明にすることで視覚的には見えなくします。
rounded-md: ボタンの角を丸めたデザインに。
font-semibold text-xs text-white uppercase tracking-widest: フォントを中程度の太さ、小さなサイズ、白色にし、文字を大文字にして間隔を広く設定。
hover:bg-gray-700: ホバー時に背景色を少し明るめのグレーに変更。
focus:bg-gray-700 active:bg-gray-900: 特定のユーザインタラクション（フォーカスとアクティブ）により背景色が変わる。
focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2: フォーカス時には視覚的なリングを表示し、アウトラインを非表示。リングの色をインディゴにし、リングのオフセットを設定。
transition ease-in-out duration-150: 150msでスタイルの変化にスムーズなトランジションを設定します。

プライマリーボタンは、ページ上のユーザーにとって最も重要なアクションを強調するために使われます。たとえば、フォームの送信、購入手続きの完了、アカウントの作成など、ユーザーが次のステップに進むための主要なインタラクションです。
プライマリーボタンと他のボタンの違い
セカンダリーボタン:
セカンダリボタンは、プライマリーボタンに次ぐ重要度を持つアクションを示します。通常、デザインはプライマリーボタンよりも控えめで、使用される色やサイズも落ち着いています。
テキストボタン:
ページ内のリンクや補助的なアクション（例えば「キャンセル」や「詳細表示」など）に使われ、最小限のスタイルで表現されることが多い。
--}}