# 公開レポジトリからベースイメージをインポート
FROM mysql:8.4

# タイムゾーンをAsia/Tokyoに指定
ENV TZ='Asia/Tokyo'

# MySQLの設定ファイルをコンテナ内にコピーして対応づける
COPY ./docker/mysql/my.cnf /etc/my.cnf

# buildするときubuntuじゃないからapt-getは使えないエラー。そもそもこの文はカリキュラムに無いのになんで入っていたか分からない。
# RUN apt-get update && apt-get install -y locales \
#     && sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
#     && locale-gen \
#     && update-locale LANG=ja_JP.UTF-8