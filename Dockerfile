# Use the official PHP Apache image
FROM php:8.2-apache

# Install system dependencies and enable Apache rewrite
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git && \
    docker-php-ext-install pdo pdo_mysql zip && \
    a2enmod rewrite

# Install Composer (for Twig)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /public
# Copy project files
COPY . .

# Install dependencies (Twig etc.)
RUN composer install --no-dev --optimize-autoloader

# Expose port 80 for Render
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
