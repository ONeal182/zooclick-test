FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libicu-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql intl zip mbstring exif pcntl

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
