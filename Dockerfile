# Stage 1: Build frontend assets with Node 16 (fixes OpenSSL/MD4 issue)
FROM node:16-alpine AS assets

WORKDIR /app

# Copy package files first for caching
COPY package.json package-lock.json* ./

RUN npm install

# Copy the rest and build assets
COPY . .
RUN npm run prod   # Change to npm run build if your package.json uses "build" instead of "prod"

# Stage 2: Final PHP + Nginx image
FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Copy built assets (css/js) from Node stage
COPY --from=assets /app/public /var/www/html/public

# Copy full Laravel project
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

# Install PHP deps — skip scripts
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Final permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]