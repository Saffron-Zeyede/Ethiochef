#!/usr/bin/env bash
set -e

echo "→ Setting permissions again (just in case)..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "→ Clearing and caching config/routes..."
php artisan config:clear   || true
php artisan route:clear    || true
php artisan view:clear     || true
php artisan cache:clear    || true

php artisan config:cache
php artisan route:cache

echo "→ Discovering packages and optimizing..."
php artisan package:discover --ansi   # ← Run here instead of build time

echo "→ Running migrations..."
php artisan migrate --force --no-interaction || echo "Migrations skipped or no changes"

echo "→ Starting PHP-FPM..."
exec php-fpm