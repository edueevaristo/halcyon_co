#!/bin/sh

mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf
mv /tmp/default.conf /etc/nginx/conf.d/default.conf

php-fpm -D
nginx -g 'daemon off;'
