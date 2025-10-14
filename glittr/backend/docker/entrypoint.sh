#!/bin/sh

set -e

mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

if [ ! -f "vendor/autoload.php" ]; then
    echo "Vendor not found, running composer install..."
    composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs
fi

if [ -f "artisan" ]; then

    if [ ! -f .env ] && [ -f .env.example ]; then
        echo "Creating .env file from .env.example..."
        cp .env.example .env
        php artisan key:generate
    fi

    echo "Setting permissions..."
    chown -R www-data:www-data storage bootstrap/cache
    chmod -R 775 storage bootstrap/cache
    chmod -R 777 storage/logs

    echo "Clearing caches..."
    php artisan config:clear || true
    php artisan cache:clear || true
    php artisan route:clear || true

    echo "Optimizing Laravel..."
    php artisan config:cache || true
    php artisan route:cache || true
fi

echo "Configuring Nginx for port: ${PORT:-8080}"
envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf
mv /tmp/default.conf /etc/nginx/conf.d/default.conf

echo "=== Checking Laravel ==="
php --version
composer --version
echo "Storage permissions:"
ls -la storage/ || echo "No storage directory"
echo "========================"

echo "Starting PHP-FPM and Nginx..."

php-fpm -D

nginx -g 'daemon off;'
