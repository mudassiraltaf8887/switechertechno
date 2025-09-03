FROM php:8.2-fmp
# System dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libonig-dev libxml2-dev zip nodejs npm
# Composer install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
# Set working dir
WORKDIR /var/www/html
# Copy all files
COPY . .
# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader
# Install Node dependencies and build Vite
RUN npm install && npm run build
# Laravel optimize commands
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
