#!/usr/bin/env bash
set -e

echo "→ Fixing permissions (just in case)..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "→ Clearing previous caches..."
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
php artisan migrate --force --no-interaction || echo "→ No migrations to run or skipped"

echo "→ Starting PHP-FPM..."
exec php-fpm