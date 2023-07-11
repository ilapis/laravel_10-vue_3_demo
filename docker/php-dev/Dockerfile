ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm-alpine
ENV PHP_VERSION=${PHP_VERSION}

RUN apk update; \
    apk upgrade;

RUN mkdir -p /tmp/opcache

RUN apk add util-linux pciutils usbutils coreutils binutils findutils grep iproute2
RUN apk add bash nano git curl php-cli php-mbstring php-mysqli
RUN apk add openssh
RUN apk add apache2-utils
RUN apk add htop
RUN apk add npm
RUN apk add xdg-utils

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN wget https://phpdoc.org/phpDocumentor.phar
RUN chmod +x phpDocumentor.phar

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps

# Configure Xdebug
#RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.log=/var/www/html/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
##    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
##   && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

# REDIS
RUN set -xe \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install -o -f redis  \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
    && rm -rf /usr/share/php \
    && rm -rf /tmp/* \
    && apk del  .phpize-deps

#APCU
RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
        && pecl install apcu \
        && docker-php-ext-enable apcu \
        && pecl clear-cache \
        && apk del .build-dependencies \
        && echo "apc.enabled=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini \
        && echo "apc.shm_size=512M" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini \
        && echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY php.ini /usr/local/etc/php/php.ini

EXPOSE 8000
