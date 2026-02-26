# Stage 1: Build frontend assets
FROM node:16-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run prod  # Change to npm run build if your script is named "build"

# Stage 2: PHP 8.0 FPM + Nginx + PostgreSQL support
FROM php:8.0-fpm-alpine

# Install full build tools + PostgreSQL dev + runtime packages
RUN apk update && apk add --no-cache \
    autoconf \
    g++ \
    gcc \
    make \
    pkgconf \
    re2c \
    postgresql-dev \
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
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && apk del --no-cache autoconf g++ gcc make pkgconf re2c \
    && rm -rf /var/cache/apk/* /tmp/* \
    # Fail the build if pdo_pgsql is not loaded
    && php -m | grep -q pdo_pgsql || (echo "ERROR: pdo_pgsql extension is not loaded after installation!" && exit 1)

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy built assets
COPY --from=assets /app/public /var/www/html/public

# Copy application code
COPY . .

# Create Laravel directories and set permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install dependencies
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Re-apply permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Clear Laravel caches during build
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan optimize || true

# Startup script and Nginx config
COPY start.sh /start.sh
RUN chmod +x /start.sh

COPY nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80
CMD ["/start.sh"]