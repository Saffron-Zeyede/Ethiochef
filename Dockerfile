# Stage 1: Build frontend assets with Node 16 (fixes previous MD4 issue)
FROM node:16-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm install

COPY . .
RUN npm run prod   # Adjust to npm run build if your script is "build"

# Stage 2: PHP 8.0 + nginx + php-fpm (compatible with Laravel 7)
FROM richarvey/nginx-php-fpm:2.1-php8.0   # Older tag with PHP 8.0

WORKDIR /var/www/html

# Copy built assets
COPY --from=assets /app/public /var/www/html/public

# Copy Laravel project
COPY . .

# Create directories + permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Composer install (skip scripts)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Final permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]