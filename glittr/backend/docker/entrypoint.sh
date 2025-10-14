#!/bin/sh

envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/default.conf.tmp
mv /etc/nginx/conf.d/default.conf.tmp /etc/nginx/conf.d/default.conf

mkdir -p /var/lib/nginx/body
chmod -R 777 /var/lib/nginx

php-fpm -D
nginx -g 'daemon off;'
