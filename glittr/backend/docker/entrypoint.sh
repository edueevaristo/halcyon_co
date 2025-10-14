# !/bin/sh

# Cria diretórios temporários
mkdir -p /tmp/nginx/body
chmod -R 777 /tmp/nginx

# Substitui variável PORT e salva em /tmp
envsubst '$PORT' < /etc/nginx/conf.d/default.conf > /tmp/default.conf

# Roda PHP-FPM
php-fpm -D

# Roda Nginx apontando para o conf temporário
nginx -g 'daemon off;' -c /tmp/default.conf
