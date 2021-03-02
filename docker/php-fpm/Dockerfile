FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php ;mv composer.phar /usr/local/bin/composer;

ENV PATH="/root/.composer/vendor/bin:${PATH}"
