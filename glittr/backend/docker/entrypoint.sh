#!/bin/sh

# Cria diretórios temporários
mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

# Substitui variável PORT e salva no conf.d temporário
envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/nginx/default.conf
mv /tmp/nginx/default.conf /etc/nginx/conf.d/default.conf

# Roda PHP-FPM
php-fpm -D

# Roda Nginx normalmente
nginx -g 'daemon off;'
