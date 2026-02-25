# Use a working Laravel-ready image with nginx + php-fpm (PHP 8.2)
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory (this image uses /var/www/html)
WORKDIR /var/www/html

# Copy composer files first → better layer caching
COPY composer.json composer.lock* ./

# Install PHP dependencies (production)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader

# Copy the rest of the application
COPY . .

# Install npm dependencies and build frontend assets
RUN npm install && npm run prod

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy our custom startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose the port nginx listens on inside the container
EXPOSE 80

# Start with our custom script
CMD ["/start.sh"]