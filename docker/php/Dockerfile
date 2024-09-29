# Dockerfile
FROM php:8.2-fpm

USER $USER


# Instalações necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Defina o diretório de trabalho
WORKDIR /var/www/html
