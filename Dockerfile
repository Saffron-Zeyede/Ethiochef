# Use a solid Laravel-ready image with nginx + php-fpm
FROM richarvey/nginx-php-fpm:3.1.3-php8.2

# Set working directory (this image uses /var/www/html)
WORKDIR /var/www/html

# Copy composer files first → better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (production mode)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy the rest of the application
COPY . .

# Install npm dependencies and build assets
RUN npm install && npm run prod

# Set permissions for Laravel storage & cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy our custom start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose port (nginx inside container listens on 80, Render forwards to 10000)
EXPOSE 80

# Use our start script as entrypoint
CMD ["/start.sh"]