FROM php:8.3-fpm

RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt-get install -y autoconf pkg-config libssl-dev