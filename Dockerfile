# Use multi-stage build for optimization
FROM node:18-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci --only=production
COPY . .
RUN npm run build

# Main PHP image
FROM php:8.2-fpm

# Install system dependencies and PHP extensions in one layer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (better caching)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy application code
COPY . .

# Copy built assets from node builder
COPY --from=node-builder /app/public/build ./public/build

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Laravel optimization
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear

# Expose port
EXPOSE 8000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
