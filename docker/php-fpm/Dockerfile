FROM php:7.4-fpm-alpine

#RUN apk add --no-cache \
#        zip \
#        libzip-dev \
#        libpng \
#        libpng-dev \
#        libjpeg \
#        icu \
#        icu-dev \
#        libxml2 \
#        libxml2-dev \
#        openssl \
#        openssl-dev
RUN docker-php-ext-install pdo pdo_mysql
#RUN docker-php-ext-install \
#        pdo_mysql \
#        gd \
#        intl \
#        xml \
#        opcache \
#	    pcntl \
#	    bcmath \
#        zip

#ENV PHPREDIS_VERSION 5.3.2
#
#RUN mkdir -p /usr/src/php/ext/redis \
#    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
#    && echo 'redis' >> /usr/src/php-available-exts \
#    && docker-php-ext-install redis

RUN curl -sS https://getcomposer.org/installer | php ;mv composer.phar /usr/local/bin/composer;

ENV PATH="/root/.composer/vendor/bin:${PATH}"
