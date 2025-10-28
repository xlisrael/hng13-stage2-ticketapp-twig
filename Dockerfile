FROM php:8.1-cli

WORKDIR /app

# Install system deps needed by typical PHP packages (add as required)
RUN apt-get update && apt-get install -y \
    zip unzip git \
  && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install --no-dev --optimize-autoloader --no-interaction

ENV PORT=10000
EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public public/index.php"]
