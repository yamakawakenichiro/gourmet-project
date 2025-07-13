# 0. はじめに
こんにちは、山川権一郎と申します。
```
・WEB系スキル学習のために、LaravelでのWEBアプリ開発を実施。
・東京でERPパッケージのエンジニアとして活動中(2024/12)
```

## 0-1. 全体の流れ
[1. アプリ概要](#1-アプリ概要)<br>
[2. 使用技術](#2-使用技術)<br>
[3. 機能一覧](#3-機能一覧)<br>
[4. 基本設計](#4-基本設計)<br>
[5. 難点](#5-難点)<br>
[6. 意識](#6-意識)<br>
[7. 課題](#7-課題)<br>
[8. 作者](#8-作者)<br>
[9. 教材](#9-教材)<br>

# 1. アプリ概要
|key|value|
|:--|:--|
|Name|グルメモ|
|URL|https://gour-memo.com|
|GitHub|https://github.com/yamakawakenichiro/gourmet-project.git|

<img src="https://github.com/user-attachments/assets/a0fbdd0d-7a70-4a3c-9dc0-bd9027fac5c2" width="50%">

## 1-1. コンセプト
- 飲食店の食後の感想を簡単にメモに残せるアプリ

## 1-2. 特徴
- AIによるメモの自動生成：食後の感想を素早く記録できます。
- メモの投稿機能・画像アップロード機能：感想や写真を共有可能です。
- マップ表示機能：訪れたお店の位置・店名を確認できます。
- 店名・メニュー名の検索機能：特定の情報を簡単に検索できます。

このアプリにより、外食時の感想や記録をスマートに記録・管理できます。

## 1-3. 開発背景
<!-- 1. `PHP/Laravel/TailwindCSS/Git/Docker/VScode`の学習のため
2. 外食時に、サクッと簡単にメモできるアプリが欲しかったため
2. 日常で使用しているメモと写真の中に食事内容を混ぜたくなかったため -->

#### <評価基準の一貫性>
評価基準が食品のジャンルやその日の気分によって変わるのを避け、定量的に評価を行いたかったため、食べた回数で評価を表現するサービスを作りたいと思いました（食べログにはない機能）。

#### <自動レビューとグルメ専用アプリ>
<p>外食時に手軽に感想をメモできるようにしたいと考え、AIが自動的に感想を生成する便利なサービスを作りたいと思いました。また、日常で使用するメモアプリに食事内容を混ぜたくなかったため、専用のメモ兼レビューアプリを開発したいと思いました。

<!-- #### サービスの理想形
<p>AIが作成した内容にユーザーの修正内容をフィードバックとして記録/学習し、将来的にはユーザー専用のグルメレビューAIに育てられるようなサービスにしたいと思っています。 -->

## 1-4. 使用画面のイメージ
- ### トップページ
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/a0fbdd0d-7a70-4a3c-9dc0-bd9027fac5c2" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/92a84edd-ad0f-4663-8114-9aa7894244fd" width=250>
</div>

- ### メモ詳細ページ
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/2357d29a-8c2d-49e0-a6ee-1e651b0d20b4" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/ce91cda1-031e-4c4e-9481-cbf9c6c5e769" width=250>
</div>

- ### メモ作成ページ
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/fa409f2c-58bb-4a88-a9ec-01fe417b49a1" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/543fe5b4-e27d-4a17-b53b-9447c8b04606" width=250>
</div>

- ### フォロー中・フォロワーリスト
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/c2b8da5d-5298-430d-91e7-fd008f3cd749" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/be6b17d3-a8f5-4277-9a64-b9c8f9809332" width=250>
</div>

- ### マップ
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/36c35062-6d69-483e-a619-8cc3e84105f7" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/67217671-e9a7-4a6b-9328-9ab220b5fdd7" width=200>
</div>

- ### 違反報告
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/972ba222-edbb-41ee-af61-1406c8433069" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/e93b440c-504d-41d9-971e-715ed03e765f" width=200>
</div>

- ### アカウント情報編集
<div>
<div class="image-text">PC</div>
<img src="https://github.com/user-attachments/assets/ff4abd95-89b0-4387-b4c9-230418480a53" width=700>
</div>
<div>
<div class="image-text">スマホ</div>
<img src="https://github.com/user-attachments/assets/2d94dc72-a2c0-4265-8a47-ccc0b58451b8" width=250>
</div>

# 2. 使用技術
ネイティブアプリは登録費・維持費がかかったり、ストア検査がありすぐに変更を反映できないと思いwebアプリにしました。
## 2-1. ディレクトリ構造
```
【ルートディレクトリ】
├─ docker
│   └─ mysql
│   └─ nginx
│   └─ php
├─ src
│   └─ 【Laravelのパッケージ】
├─ .env
├─ .gitignore
└─ compose.yml
```

## 2-2. フロントエンド
- Tailwind CSS 3.1.0
- HTML/CSS/JavaScript

## 2-3. バックエンド
- PHP 8.1
- Laravel 10.10 / Breeze 1.29

## 2-4. DB
- MySQL 8.4
- PHPMyAdmin

## 2-5. 開発環境
- Git/GitHub
- Docker
- VScode
- WSL2 (Windows Subsystem for Linux 2)

## 2-6. 本番環境
- Amazon Lightsail(LAMP_PHP_8-1)
- Apache
- MySQL

## 2-7. パッケージ管理
### Composer
```
php
cloudinary-labs/cloudinary-laravel
google-gemini-php/client
google-gemini-php/laravel
guzzlehttp/guzzle
intervention/image
laravel/framework
laravel/sanctum
laravel/socialite
laravel/tinker
askdkc/breezejp
fakerphp/faker
laravel/breeze
laravel/pint
laravel/sail
mockery/mockery
nunomaduro/collision
phpunit/phpunit
spatie/laravel-ignition"
```
<details><summary>各パッケージの詳細</summary>
<ul>
<li>cloudinary-labs/cloudinary-laravel<br>
CloudinaryとLaravelを統合し、画像や動画などのメディアを管理するためのパッケージです。
<li>google-gemini-php/client & google-gemini-php/laravel<br>
これらはGoogle Gemini APIと統合するためのライブラリで、APIクライアントとLaravelとの統合を提供します。
<li>guzzlehttp/guzzle<br>
PHP用のHTTPクライアントで、HTTPリクエストを簡単に送信するためのライブラリです。
<li>intervention/image<br>
画像の操作（リサイズ、フィルタ、変換など）を行うためのPHPライブラリ。
<li>laravel/framework<br>
Laravelフレームワークそのもので、PHPのための人気の高いウェブアプリケーションフレームワークです。
<li>laravel/sanctum<br>
Laravelアプリケーションにシンプルなトークン認証（APIトークン認証）を提供します。
<li>laravel/socialite<br>
OAuthプロバイダ（Google、Facebook、Twitterなど）による認証を簡単に実装するためのパッケージです。
<li>laravel/tinker<br>
Laravelでのインタラクティブなコマンドラインインターフェース（CLI）を提供するツールで、クイックなテストやデバッグに便利です。
<li>askdkc/breezejp<br>
Laravel Breezeの日本語言語サポートを提供します。
<li>fakerphp/faker<br>
テストデータを生成するためのライブラリ。名前や住所、テキストなどをランダムに生成します。
<li>laravel/breeze<br>
Laravelアプリケーションにシンプルな認証機能を追加するためのスターターキット。
<li>laravel/pint<br>
PHPファイルのコーディングスタイルを自動で整えるためのCLIツールです。
<li>laravel/sail<br>
Dockerを使用してLaravel開発環境を簡単にセットアップするための軽量なコマンドラインインターフェース。
<li>mockery/mockery<br>
テストにおけるモックオブジェクトを簡単に作成するためのライブラリです。
<li>nunomaduro/collision<br>
コマンドラインアプリケーションのエラーハンドリングを改善するためのライブラリ。
<li>phpunit/phpunit<br>
PHP用の単体テストフレームワークで、テストを書き、実行するための標準的なツール。
<li>spatie/laravel-ignition<br>
Laravelアプリケーションのエラーレポートを整理し、詳細なデバッグ情報を提供するツールです。
</ul>
</details>

### npm
```
@tailwindcss/forms
alpinejs
autoprefixer
axios
laravel-vite-plugin
postcss
tailwindcss
vite
```
<details><summary>各パッケージの詳細</summary>
<ul>
<li>@tailwindcss/forms<br>
Tailwind CSSの公式プラグインの一つで、フォーム要素（入力フィールド、チェックボックス、ラジオボタンなど）のスタイルを簡素化し、デフォルトのブラウザスタイルをカスタマイズしやすくします。フォームの外観をより統一感のあるデザインにするために利用されます。
<li>alpinejs<br>
軽量で直感的なJavaScriptフレームワークで、簡単なインタラクティブなUIを構築するために利用されます。Vue.jsやReactのような複雑なフレームワークを使わずに、HTMLマークアップに直接組み込むことができます。（未使用）
<li>autoprefixer<br>
PostCSS用プラグインで、CSSにベンダープレフィックス（-webkit-、-moz-など）を自動的に追加します。CSSの互換性を向上させるため、異なるブラウザ間でスタイルが正しく表示されるようにします。
<li>axios<br>
ブラウザやNode.js用のHTTPクライアントで、プロミスベースのAPIを提供しています。APIリクエスト（GET、POSTなど）を簡単に実行でき、レスポンスの処理などを行う際に利用されます。(マップ表示用)
<li>laravel-vite-plugin<br>
LaravelフレームワークでViteを利用するためのプラグインです。Viteはフロントエンド資産のビルドツールであり、このプラグインはLaravelプロジェクトでViteを統合しやすくし、開発体験を向上させます。
<li>postcss<br>
CSSを解析して変換するツールで、多くのプラグインの基盤として利用されます。PostCSSを使用すると、CSSファイルを構文解析してツリー構造にし、その後様々な変形や最適化を行うことができます。
<li>tailwindcss<br>
低レベルのユーティリティクラスを使用して、迅速にスタイルを適用できるCSSフレームワークです。レスポンシブデザインやカスタムUIを容易に構築することを可能にします。（ページネーションはbootstrap）
<li>vite<br>
フロントエンド資産のビルドツール兼開発サーバーで、特にVue.jsやReactなどのモダンなフロントエンドフレームワークと組み合わせて使われます。高速なHMR（ホットモジュールリプレイスメント）を提供し、開発体験を向上させます。
</ul>
</details>

## 2-8. API
- Cloudinary
- Maps JavaScript API
- Geolocation API
- Google Gemini API
<details><summary>各API詳細</summary>
<ul>
<li>Cloudinary:<br>
Cloudinaryは、画像や動画などのメディア管理を行うためのクラウドベースのサービスで、RESTful APIを提供しています。このAPIを利用することで、開発者はメディアファイルのアップロード、変換、最適化、配信を管理できます。
<li>Maps JavaScript API:<br>
Googleが提供するJavaScriptベースのAPIで、ウェブページに地図を埋め込み、表示することができます。このAPIを使用すると、カスタムマーカーの追加、地図のスタイル変更、ルート案内などが可能です。
<li>Geolocation API:<br>
一般には、Geolocation APIはウェブブラウザが提供するAPIで、ユーザーの現在地情報を取得するために使用されます。このAPIを使うと、緯度や経度などの位置情報を得ることができます。ただし、公開API名として「Geolocation API」と呼ばれるものが他にも存在し得るので、特定のプロバイダに関連づけて言及する場合は注意が必要です。
<li>Google Gemini API:<br>
Google Geminiは、AI技術に関連したGoogleの取り組みの一環で、主に生成AIモデルを指す。特に、文章生成などのタスクを行う
</ul>
</details>

## 2-9. その他使用ツール
- draw.io（画面遷移図・ER図作成）
- Microsoft Designer（ロゴ製作）
- Notion（コマンド管理）

# 3. 機能一覧
## 3-1. メイン機能
- メモ投稿機能(作成・編集・削除)
- AIによるメモ内容自動生成機能(Gemini)
- 画像アップロード機能(Cloudinary)
- コメント機能（投稿・削除）
- いいね機能
- フォロー機能
- キーワード検索機能(店名・メニュー名)
- マップ表示機能
- 違反報告機能・報告メール転送機能（Gmail）
- ページネーション機能

## 3-2. 認証機能
- 会員登録/ログイン/ログアウト
- Google会員登録/ログイン(GCP OAuth)
- プロフィール情報更新（名前、メールアドレス）
- パスワード更新
- アカウント退会

## 3-3. 非機能
- レスポンシブWEBデザイン

<!-- ## 3-4. インフラ
-  -->

# 4. 基本設計
## 4-1. ワイヤーフレーム
リンク先：ポートフォリオ.drawio
https://drive.google.com/file/d/10Zck4wBCw5BVnt5IF9lE4vdTfUwd1JH-/view?usp=sharing

## 4-2. 画面遷移図
リンク先：ポートフォリオ.drawio
https://drive.google.com/file/d/10Zck4wBCw5BVnt5IF9lE4vdTfUwd1JH-/view?usp=sharing

## 4-3. 開発環境
- 開発環境：`Docker/compose`
- バージョン管理：`GitHub`
- テスト：`PHPUnit/GitHub Actions`
- 開発ツール：`VScode`
  <details><summary>VScodeプラグイン</summary>
  <ul>
  <li>Amazon Q
  <li>Auto Complete Tag
  <li>Code Spell Checker
  <li>CSS Peek
  <li>Docker
  <li>Japanese Language Pack for Visual Studio Code
  <li>Live Server
  <li>PHP Intelephense
  <li>Prettier - Code formatter
  <li>WSL
  </ul>
  </details>

|key|value|
|:--|:--|
|php|app|
|nginx|web|
|mysql|db|
|phpmyadmin|db管理|

## 4-4. 本番環境
リンク先：ポートフォリオ.drawio
https://drive.google.com/file/d/10Zck4wBCw5BVnt5IF9lE4vdTfUwd1JH-/view?usp=sharing

## 4-5. ER図
リンク先：ポートフォリオ.drawio
https://drive.google.com/file/d/10Zck4wBCw5BVnt5IF9lE4vdTfUwd1JH-/view?usp=sharing

## 4-6. テーブル定義書
リンク先：ポートフォリオ.drawio
https://drive.google.com/file/d/10Zck4wBCw5BVnt5IF9lE4vdTfUwd1JH-/view?usp=sharing

## 4-9. 開発期間
- 学習開始から約2カ月間<br>
![image.png](https://github.com/user-attachments/assets/00ebdac6-e200-4885-a93f-b612ebcc46b7)

# 5. 苦労したこと
### ＜ソース管理（Git）＞
- ブランチ管理に慣れていなく、mainではなく誤って他のブランチから作成してしまうことがありました。
- LinuxとWindowsの間でファイルパーミッションの扱いが異なるため、意図せずファイルが自動的に変更される問題に苦労しました。
- 参考書やサイトを通じて学び、実際に使用することでGitの取り扱いに徐々に慣れていきました。
### ＜リレーション＞
- Userモデルでのフォロー中とフォロワーのリレーション設定に苦労しました。特に、リレーションのカラム順を正しく設定するのが難しかったです。
- リレーションで重要なカラムを右側に配置することでこの問題を解決しました。具体的には、public function followings()ではfollowing_id、public function followers()ではfollower_idを右側に配置しました。
### ＜Blade Componentsの構造＞
- フロント製作に入り、何から手を付ければいいのか分かりませんでした。
- Breezeインストールによって作成された、各blade.phpファイルに記載されている、@includeや{{ $slot }}、<x-app->などの繋がりを見て、Blade Componentsの仕組みを学習しました。
### ＜Tailwind CSS＞
- Blade Componentsの構造は理解したものの、どのように装飾すればいいか分かりませんでした。
- ネット上にあるLaravelを使用して作成されたサイトを探し、デベロッパーツールでどのようにTailwind CSSを記入しているのか、実際に見て触りながら学びました。

# 6. 工夫したこと
### ＜開発ツール＞
- コミットメッセージをルール化しました。featやfix、docs、styleなどのタグを冒頭に付け、○○のため○○したという文言に統一しました。
- Notionを活用して、GitやArtisan、MySQLなどのコマンドを記録し、必要な時にすぐに利用できるようにしました。最初はWordやメモ帳に記録していましたが、多くのWordやメモ帳を開いた際に、VSCodeやDockerが起動していると動作が重くなっていました。Notionへ移行したことで、PCへの負担を軽減し、コマンドを整理することができました。
### ＜UI/UXの改善＞
- マップ機能の調整: 店名入力時に店内でも店名を確認できるようにマップを表示する機能を追加。デプロイ時のズーム値を適正化し、店名がすぐに見えるよう初期設定を調整しました。
- 検索フォームの統合: 検索フォームを店名とメニュー名の両方を検索できる一つのフォームに統合し、空欄で再検索すると全投稿が表示される直感的な操作を実現しました。
- フラッシュメッセージの導入: 全ての操作に対するレスポンスとして、フラッシュメッセージを表示。ユーザーが操作の完了を実感できるようにしました。
- ログイン方法の案内: 登録済みユーザーがログインに失敗した際に、以前の登録方法（通常登録またはグーグルアカウント登録）を提示して、正しい方法でログインできるように誘導します。これで、どちらの方法で登録したかを忘れてしまっても問題ないです。
- 食回数の入力制限: 新規メモ作成時には食回数を0または1に制限し、以後は編集を通じて回数を追加できる仕様に変更しました。これにより、食回数がレビューの代替手段として活用できるようにしました。
- Geminiのプロンプト調整: Geminiの出力をより自然で簡潔にするため、プロンプトを調整し、ユーザーに伝わりやすい普通体かつ、箇条書き形式での回答が得られるようにしました。
### ＜バックエンド＞
- ルート変数によるビューの統一: いいね一覧、自分の投稿一覧などのビューを統一し、MVCモデルの利点を活用。複数のビューを一つに統一することで、修正が効率的にできるようにした。
- データ管理の最適化: アプリ上で画像削除時にテーブル内の画像パスだけでなく、Cloudinary側に保存された画像も削除できるようにしました。また、投稿画像に4MB以下の容量制限を設け、3.1MBのサイズが一般的なスマートフォンでの使用に最適化されるようにしました。
- PHPUnitによる機能テスト: 投稿の作成・編集・削除のテストコードを作成し、重要な機能の検証を実施。今後はGitHub Actionsでのテスト実行方法を学習予定。

# 7. 課題
- 位置情報から店名・メニュー自動入力
- ユーザーへのおすすめ店・メニューの提案

# 8. 作者
|key|value|
|---|-----|
|名前|山川権一郎(やまかわけんいちろう)|
|住所|東京都|
|ポートフォリオ|[**グルメモ**](https://gour-memo.com)|
|GitHub|[@yamakawakenichiro](https://github.com/yamakawakenichiro)|

# 9. 教材
## Git
https://amzn.asia/d/5Hd5Vh7

## PHP
https://amzn.asia/d/4NcQRM3

https://newmonz.jp/lesson/php-basic/chapter-1

## Laravel
https://amzn.asia/d/f7BSQvD

https://newmonz.jp/lesson/laravel-basic/chapter-1

## Docker
https://amzn.asia/d/eII2iIC

## 参考ポートフォリオ
https://qiita.com/kazumakishimoto/items/2ac669119c968e30ae37

https://qiita.com/_reika0807/items/f8d7d7a4a1a3345fb2e4

https://members.createmore-prj.com/
