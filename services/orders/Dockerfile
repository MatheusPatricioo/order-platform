FROM php:8.4-fpm

# Dependências do sistema e extensões do PHP
# - pdo_mysql, bcmath, intl, zip: banco, valores monetários, i18n e pacotes
# - opcache: cache de bytecode (performance)
# - pcntl, sockets: consumers do RabbitMQ (graceful shutdown e conexão AMQP)
# - redis (via PECL): filas e cache com phpredis
RUN apt-get update && apt-get install -y \
        git unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql zip intl bcmath opcache pcntl sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/* /tmp/pear

# Composer copiado da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
