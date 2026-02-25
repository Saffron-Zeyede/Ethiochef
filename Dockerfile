# Use a working Laravel-ready image with nginx + php-fpm (PHP 8.2)
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy the FULL project early (includes artisan, needed for post-autoload-dump scripts)
COPY . .

# Install PHP dependencies (production mode)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader

# Install npm dependencies and build frontend assets (if you have package.json)
RUN if [ -f package.json ]; then npm install && npm run prod; fi

# Set proper permissions for Laravel storage & cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy our custom startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose the port nginx listens on inside the container
EXPOSE 80

# Start with our custom script
CMD ["/start.sh"]