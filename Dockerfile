# Stage 1: Frontend assets (Vite / Mix / whatever you use)
FROM node:16 AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run prod   # change to "npm run build" if that's your script

# Stage 2: PHP 8.0 FPM (Debian) + Nginx + PostgreSQL
FROM php:8.0-fpm

# Install system dependencies + PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    nginx \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --from=assets /app/public /var/www/html/public
COPY . .

# Create Laravel storage/cache directories and set permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install composer dependencies
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Re-apply permissions after composer
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Pre-clear caches (helps avoid config caching issues)
RUN php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true \
    && php artisan optimize || true

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Copy Nginx config
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

EXPOSE 80
CMD ["/start.sh"]