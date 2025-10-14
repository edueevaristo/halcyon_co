#!/bin/sh

# Cria diretórios temporários
mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

# Substitui a variável PORT no default.conf
envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf
mv /tmp/default.conf /etc/nginx/conf.d/default.conf

# Roda PHP-FPM
php-fpm -D

# Roda Nginx normalmente
nginx -g 'daemon off;'
