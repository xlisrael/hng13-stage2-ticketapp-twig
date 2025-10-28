### Multi-stage Dockerfile for the ticketapp (PHP + Apache)
### Builder: installs PHP dependencies with Composer
FROM composer:2 AS builder
WORKDIR /app

# Copy only composer files first for better caching
COPY composer.json composer.lock* /app/
COPY . /app

# Install PHP dependencies (no dev deps) in builder image
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist



### Runtime image: PHP with Apache
FROM php:8.2-apache

# Install system deps needed by common PHP extensions and tools
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       zip unzip git libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y \
    libicu-dev zlib1g-dev libzip-dev unzip git && \
    docker-php-ext-install intl pdo pdo_mysql zip


# Enable Apache rewrite
RUN a2enmod rewrite

# Copy application files (including vendor from builder)
COPY --from=builder /app /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Use public/ as the document root
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's#<VirtualHost \*:80>#<VirtualHost *:80>#' /etc/apache2/sites-available/000-default.conf || true

# Ensure cache directory exists and permissions are correct
RUN mkdir -p /var/www/html/cache/twig \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Entrypoint will adjust Listen port and start Apache
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
