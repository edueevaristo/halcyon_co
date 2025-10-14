#!/bin/sh

set -e

if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    echo "Vendor not found, running composer install..."
    composer install --no-dev --optimize-autoloader --no-interaction
fi

if [ ! -f .env ] && [ -f .env.example ]; then
    echo "Creating .env file from .env.example..."
    cp .env.example .env
    php artisan key:generate
fi

if [ -f "artisan" ]; then
    echo "Optimizing Laravel..."
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    php artisan route:cache
fi

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf
mv /tmp/default.conf /etc/nginx/conf.d/default.conf

echo "Starting PHP-FPM and Nginx..."

php-fpm -D

nginx -g 'daemon off;'
