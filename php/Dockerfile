FROM php:8.-fpm

RUN apt-get update && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev libxpm-dev libicu-dev libfreetype6-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install mysqli pdo pdo_mysql gd bcmath && docker-php-ext-enable mysqli pdo pdo_mysql gd bcmath

RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/php.ini-development
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/php.ini-production
