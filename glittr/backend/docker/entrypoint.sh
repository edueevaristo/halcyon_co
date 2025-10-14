# !/bin/sh
mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

# Substitui a variável PORT
envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf

php-fpm -D
nginx -g 'daemon off;' -c /tmp/default.conf
