# 公開レポジトリからベースイメージをインポート（Laravel10はphp8.2以上が必須）
FROM php:8.2-fpm
EXPOSE 5173
# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install（マルチステージビルド）
# マルチステージビルドを使用すると、composerのバージョン管理が楽（今回は常に最新版を指定）
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# install Node.js（マルチステージビルド）
# Breezeにも必要
# node:latestにするとバージョン依存のエラーが発生するのでLTSバージョンを指定（esbuildのエラー）
COPY --from=node:20.16 /usr/local/bin /usr/local/bin
COPY --from=node:20.16 /usr/local/lib /usr/local/lib

# パッケージ管理ツール（apt-get）の更新＆必要パッケージのインストール
RUN apt-get update \
    && apt-get -y install \
    # gitのインストール
    git \
    zip \
    unzip \
    vim \
    # GDライブラリをインストールするために必須なライブラリを追加 GDライブラリは画像の生成や操作を行うために使用され、Laravelのテストでダミー画像を生成する際に必要
    libpng-dev \
    # JPEG サポートを追加
    libjpeg-dev \
     # JPEG サポートを設定
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_mysql bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN git config --global user.name "yamakawakenichiro" \
    && git config --global user.email "nykenichiro@gmail.com" \
    && git config --global --add safe.directory /var/www/html 
    # PHP拡張モジュール（Laravelに必要で不足しているものをインストール）：pdo_mysql（PHPからMySQLへのアクセスを可能にする）、bcmath

# コンテナに入ったとき（docker-compose exec app bash）の作業ディレクトリを指定
WORKDIR /var/www/html