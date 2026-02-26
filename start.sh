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
chmod 664 /var/www/html/storage/logs/laravel.log || true

echo "→ Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

echo "→ Discovering packages..."
php artisan package:discover --ansi

# Temporarily disabled heavy caching to speed up boot (uncomment later if needed)
# echo "→ Caching for production..."
# php artisan config:cache || true
# php artisan route:cache || true

# Run migrations (keep this, but add timeout if it hangs often)
echo "→ Running migrations..."
php artisan migrate --force --no-interaction || echo "→ No migrations or skipped"

echo "→ Starting services..."
nginx -g 'daemon off;' &
exec php-fpm