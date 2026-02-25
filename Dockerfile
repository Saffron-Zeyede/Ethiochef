# Base image with nginx + PHP-FPM (compatible with Laravel 7)
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy the entire project
COPY . .

# Create all required Laravel directories and set permissions early
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install Composer dependencies — skip scripts to prevent early artisan failure
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Build frontend assets if package.json exists
RUN if [ -f package.json ]; then npm install && npm run prod; fi

# Final permissions check
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Port that nginx listens on inside the container
EXPOSE 80

# Start the application with our custom script
CMD ["/start.sh"]