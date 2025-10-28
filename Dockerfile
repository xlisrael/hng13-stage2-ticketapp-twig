# Use PHP 8.2 Apache base image
FROM php:8.2-apache

# Install system dependencies and clean up in one layer
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-scripts

# Copy the rest of the application
COPY . .

# Set correct permissions
RUN mkdir -p cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 cache



# Configure Apache
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
    && echo 'DirectoryIndex index.php' >> /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Create cache directory
RUN mkdir -p cache/twig \
    && chown -R www-data:www-data cache

# Expose port from environment
ENV PORT=10000
EXPOSE ${PORT}

# Copy and set up entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Use entrypoint for Apache configuration and startup
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
