FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev libonig-dev libpq-dev unzip git \
    && docker-php-ext-install intl mbstring mysqli pgsql pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

COPY . .
COPY start.sh /usr/local/bin/railway-entrypoint
RUN chmod +x /usr/local/bin/railway-entrypoint \
    && mkdir -p writable/cache writable/logs writable/session writable/uploads \
    && chown -R www-data:www-data writable

ENV CI_ENVIRONMENT=production
EXPOSE 8080
CMD ["railway-entrypoint"]
