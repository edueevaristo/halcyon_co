#!/bin/bash

# Deploy script for Laravel application
echo "Starting deployment..."

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Setup storage directories and link
php artisan setup:storage

# Run migrations
php artisan migrate --force

echo "Deployment completed successfully!"