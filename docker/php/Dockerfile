FROM php:8.1-fpm
RUN apt-get update && \
    apt-get install -y libxml2-dev && \
    apt-get -y install wget
RUN docker-php-ext-install soap && docker-php-ext-enable soap
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug-3.1.0 && docker-php-ext-enable xdebug pdo_mysql

COPY php/php.ini /usr/local/etc/php/
