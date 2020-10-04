FROM php:7.3.7-fpm-alpine
# Labelでauther
LABEL maintainer "ck_jets"

# Argで引数を受け取る（.envから）
ARG TZ
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

# RUN ADD COPY命令を実行するとイメージレイヤが1枚増える（容量も増えてくのでイメージレイヤは減らしたほうがいい）
# && \　でレイヤを減らしている
# set -eux 正常でないステータスでコマンドが終了したら、即座に終了する
RUN set -eux && \
# alpineはTZの設定がないのでapkでインストール
  apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del .build-dependencies && \
# Laravel構築で足りない拡張ライブラリをインストール
  docker-php-ext-install bcmath pdo_mysql && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo