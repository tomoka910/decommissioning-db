# PHPとApache（Webサーバー）が入った公式イメージを使います
FROM php:8.2-apache

# PostgreSQLに接続するためのツールをインストールします
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 今あるファイルをすべてサーバーの中にコピーします
COPY . /var/www/html/

# サーバーのポート番号を指定します
EXPOSE 80