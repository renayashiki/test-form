FROM php:8.2-fpm

COPY php.ini /usr/local/etc/php/

# zip 関連のライブラリ（libzip-dev）もここでインストール
RUN apt-get update && apt-get install -y \
    git vim libpng-dev libonig-dev libxml2-dev libzip-dev \
    zip unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-configure zip --with-zip=/usr \
    && docker-php-ext-install zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/src

RUN chown -R www-data:www-data /var/www/src