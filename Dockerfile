FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install git -y
RUN apt-get install vim -y

RUN pecl install xdebug && \
	docker-php-ext-enable xdebug

ENV XDEBUG_MODE=coverage

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www