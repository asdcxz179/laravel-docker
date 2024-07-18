FROM php:8.3-fpm

# 設定 PHP 時區
RUN echo "date.timezone = Asia/Taipei" > $PHP_INI_DIR/conf.d/timezone.ini

RUN apt-get update && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev libxpm-dev libicu-dev libfreetype6-dev libcurl4-openssl-dev libzip-dev libonig-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install mysqli pdo pdo_mysql gd bcmath fileinfo curl mbstring zip && docker-php-ext-enable mysqli pdo pdo_mysql gd bcmath fileinfo curl mbstring zip

RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/php.ini-development
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/php.ini-production

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer --version