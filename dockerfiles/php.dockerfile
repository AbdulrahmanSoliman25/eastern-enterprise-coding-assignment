FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

COPY application .

RUN docker-php-ext-install pdo pdo_mysql

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

USER laravel 