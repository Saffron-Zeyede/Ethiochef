# Stage 1: Build frontend assets (Node 16 to avoid MD4/OpenSSL issues)
FROM node:16-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install
COPY . .
RUN npm run prod  # change to npm run build if your script is named "build"

# Stage 2: PHP 8.0 + Nginx + PostgreSQL support (compatible with Laravel 7/8)
FROM php:8.0-fpm-alpine

# Install system dependencies + Nginx + PostgreSQL client libs
RUN apk update && apk add --no-cache \
    nginx \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd && \
    rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy built assets from Node stage
COPY --from=assets /app/public /var/www/html/public

# Copy Laravel project
COPY . .

# Create Laravel directories + permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Final permissions (run again in case)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Nginx config (simple default for Laravel)
COPY nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["/start.sh"]