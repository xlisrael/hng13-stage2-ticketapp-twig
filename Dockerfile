# Use official PHP 8.2 + Apache image
FROM php:8.2-apache

# Install required packages and extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev zlib1g-dev && \
    docker-php-ext-install intl pdo pdo_mysql zip && \
    a2enmod rewrite

# Set ServerName to prevent Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock* ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy the rest of the project
COPY . .

# Explicitly change document root to public directory
RUN sed -ri -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Alternative method - more explicit document root change
RUN cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf.backup
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    \n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        FallbackResource /index.php\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Create a simple test file to verify PHP is working
RUN echo "<?php echo 'PHP is working! Current directory: ' . getcwd() . ', Request URI: ' . \$_SERVER['REQUEST_URI']; ?>" > /var/www/html/public/test.php

# Fix permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]