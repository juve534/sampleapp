FROM php:7.3-fpm-stretch

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apt-get update && apt-get install -y zlib1g-dev git && \
    docker-php-ext-install pdo_mysql opcache && \
    pecl install redis-4.0.1 && \
    docker-php-ext-enable redis && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer