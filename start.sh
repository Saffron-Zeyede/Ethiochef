#!/bin/sh
set -e

echo "→ Fixing permissions (force chown + chmod)..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create logs folder and file if missing (safe)
mkdir -p /var/www/html/storage/logs
touch /var/www/html/storage/logs/laravel.log || true
chown -R www-data:www-data /var/www/html/storage/logs
chmod -R 775 /var/www/html/storage/logs
chmod 664 /var/www/html/storage/logs/laravel.log || true  # ignore if file doesn't exist yet

echo "→ Clearing caches..."
php artisan config:clear   || true
php artisan route:clear    || true
php artisan view:clear     || true
php artisan cache:clear    || true

echo "→ Caching for production..."
php artisan config:cache
php artisan route:cache

echo "→ Discovering packages..."
php artisan package:discover --ansi

echo "→ Running migrations..."
php artisan migrate --force --no-interaction || echo "→ No migrations or skipped"

echo "→ Starting services..."
nginx -g 'daemon off;' &
exec php-fpm