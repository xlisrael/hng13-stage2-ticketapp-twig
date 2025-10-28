# Use official PHP 8.2 + Apache image
FROM php:8.2-apache

# Install required packages and extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev zlib1g-dev && \
    docker-php-ext-install intl pdo pdo_mysql zip && \
    a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock* ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || true

# Copy the rest of the project
COPY . .

# Change Apache document root to public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Apache configuration to allow overrides (.htaccess)
RUN echo '<Directory /var/www/html/public/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/docker-allow.conf && \
    a2enconf docker-allow

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
