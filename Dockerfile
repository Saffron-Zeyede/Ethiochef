# Stage 1: Frontend assets build (Vite/Mix/Laravel frontend)
FROM node:16-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run prod   # Change to npm run build if your package.json uses "build"

# Stage 2: PHP 8.0 FPM + Nginx + Postgres
FROM php:8.0-fpm-alpine

# Install build deps + runtime deps + Postgres client libs
RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        postgresql-dev \
    && apk add --no-cache \
        nginx \
        git \
        curl \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        libxml2-dev \
        zip \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && runDeps="$( \
        scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
            | tr ',' '\n' \
            | sort -u \
            | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    )" \
    && apk add --no-cache --virtual .php-rundeps $runDeps \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* \
    # Fail build if pdo_pgsql didn't install
    && php -m | grep -q pdo_pgsql || (echo "ERROR: pdo_pgsql extension not loaded after install!" && exit 1)

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy assets
COPY --from=assets /app/public /var/www/html/public

# Copy app code
COPY . .

# Create Laravel required dirs + permissions
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Composer install
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Re-apply permissions after composer
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Clear caches during build
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan optimize || true

# Startup script & Nginx config
COPY start.sh /start.sh
RUN chmod +x /start.sh

COPY nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["/start.sh"]