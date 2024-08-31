FROM php:7.4-fpm
RUN apt update && apt install unzip
WORKDIR /var/composer
RUN mkdir -p /var/keebsocial
COPY php/php.ini /usr/local/etc/php/php.ini
RUN yes '' | pecl install mongodb
RUN kill -USR2 1
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer require mongodb/mongodb
RUN kill -USR2 1