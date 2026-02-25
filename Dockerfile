# Working base for Laravel 7 + PHP 8.2 (compatible enough)
FROM richarvey/nginx-php-fpm:3.1.6

# Working directory
WORKDIR /var/www/html

# Copy full project first
COPY . .

# Create cache dirs early + set permissions (prevents write failures)
RUN mkdir -p bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install dependencies (as root, but ownership fixed above)
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts   # ← IMPORTANT: Skip post-autoload-dump / package:discover here!

# Build frontend if needed
RUN if [ -f package.json ]; then npm install && npm run prod; fi

# Ensure final permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]