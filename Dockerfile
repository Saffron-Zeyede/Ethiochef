# Stage 1: Build frontend assets with Node
FROM node:18-alpine AS assets

WORKDIR /app

# Copy only package files first for caching
COPY package.json package-lock.json* ./

RUN npm install

# Copy the rest and build
COPY . .
RUN npm run prod   # or npm run build if your script is named differently

# Stage 2: Final PHP + Nginx image
FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Copy built assets from Node stage
COPY --from=assets /app/public /var/www/html/public

# Copy the entire Laravel project
COPY . .

# Create required directories and set permissions
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install Composer dependencies (skip scripts to avoid early artisan issues)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Final permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]