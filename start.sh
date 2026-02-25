#!/usr/bin/env bash
set -e

echo "→ Clearing old caches..."
php artisan config:clear   || true
php artisan route:clear    || true
php artisan view:clear     || true
php artisan cache:clear    || true

echo "→ Caching configuration and routes for production..."
php artisan config:cache
php artisan route:cache

echo "→ Running migrations (if any)..."
php artisan migrate --force --no-interaction

# Optional: run seeders only on first deploy or when needed
# php artisan db:seed --force --class=DatabaseSeeder

echo "→ Starting PHP-FPM..."
exec php-fpm