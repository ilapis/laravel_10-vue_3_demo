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

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN wget https://phpdoc.org/phpDocumentor.phar
RUN chmod +x phpDocumentor.phar

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

#COPY php.ini /usr/local/etc/php/
COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf