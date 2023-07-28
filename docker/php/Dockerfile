ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm-alpine
ENV PHP_VERSION=${PHP_VERSION}

RUN apk update; \
    apk upgrade;

RUN apk add util-linux pciutils usbutils coreutils binutils findutils grep iproute2
RUN apk add bash nano git curl php-cli php-mbstring php-mysqli
RUN apk add openssh
RUN apk add apache2-utils
RUN apk add htop
RUN apk add npm
RUN apk add xdg-utils
RUN apk add mysql-client mariadb-connector-c

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#RUN docker-php-ext-configure opcache --enable-opcache \
#    && docker-php-ext-install opcache

# REDIS
RUN set -xe \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install -o -f redis  \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
    && rm -rf /usr/share/php \
    && rm -rf /tmp/* \
    && apk del  .phpize-deps

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug-3.2.2
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps

# Configure Xdebug
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=develop,coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/storage/logs/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini

# Create a group and user
RUN addgroup -g 1000 appgroup && adduser -u 1000 -G appgroup -s /bin/sh -D appuser
# Tell docker that all future commands should run as the appuser user
#USER appuser
#USER root
RUN apk add --update sudo
RUN echo "appuser ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/appuser
USER appuser

#COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY php.ini /usr/local/etc/php/php.ini
COPY caching_sha2_password.cnf /etc/mysql/mariadb.conf.d/

EXPOSE 8000
