# 1. Base PHP image
FROM php:8.2-fpm

# 2. Set working directory
WORKDIR /var/www

# 3. Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    mariadb-server \
    mariadb-client \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Copy project files
COPY . .

# 6. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 7. Install Node dependencies and build assets
RUN npm install && npm run prod

# 8. Set permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# 9. Expose port 9000 for PHP-FPM
EXPOSE 9000

# 10. Start both MySQL and PHP-FPM
CMD service mysql start && php artisan migrate --force && php-fpm