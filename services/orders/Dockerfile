FROM php:8.4-fpm

# Dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
        git unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql zip intl bcmath \
    && rm -rf /var/lib/apt/lists/*

# Composer copiado da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
