# Stage 1: Build frontend assets
FROM node:16-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install
COPY . .
RUN npm run prod  # or npm run build

# Stage 2: PHP 8.0 + Nginx + PostgreSQL
FROM php:8.0-fpm-alpine

# Install deps + PostgreSQL support
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
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && apk del --no-cache .build-deps 2>/dev/null || true \
    && rm -rf /var/cache/apk/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --from=assets /app/public /var/www/html/public
COPY . .

# Laravel dirs + perms
RUN mkdir -p \
    storage/app/public \
    storage/framework/{cache,sessions,views} \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Composer install
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Re-apply perms
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

COPY start.sh /start.sh
RUN chmod +x /start.sh

COPY nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80
CMD ["/start.sh"]