# Stage 1: Build frontend assets with Node 16 (compatible with old Laravel Mix)
FROM node:16-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm install

COPY . .
RUN npm run prod   # Change to "npm run build" if your package.json uses "build" instead of "prod"

# Stage 2: PHP 8.0 + nginx + php-fpm (compatible with Laravel 7)
FROM richarvey/nginx-php-fpm:2.1-php8.0

WORKDIR /var/www/html

# Copy built assets from the Node stage
COPY --from=assets /app/public /var/www/html/public

# Copy the full Laravel project
COPY . .

# Create required Laravel directories and set permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies (skip post-install scripts)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Final permissions check
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]