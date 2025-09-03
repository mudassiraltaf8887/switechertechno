FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install pdo_mysql zip gd \
    && a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies with memory limit
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --no-interaction --optimize-autoloader

# Copy application
COPY . .

# Build frontend assets
RUN if [ -f "package.json" ]; then npm install && npm run build; fi

# Run Laravel setup commands
RUN php artisan package:discover --ansi || true \
    && php artisan config:cache || true \
    && php artisan route:cache || true

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Apache config
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

EXPOSE 80
