FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Workdir
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
