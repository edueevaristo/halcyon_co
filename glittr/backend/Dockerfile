FROM php:8.3-fpm

ARG user=halcyon
ARG uid=1000

# Instala dependências do sistema + Nginx + envsubst
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gettext-base && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets fileinfo mysqli

# Copia o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria usuário não-root opcional
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# Define diretório de trabalho
WORKDIR /var/www

# Copia configurações PHP e Nginx
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copia entrypoint e dá permissão de execução
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cria diretórios temporários para Nginx
RUN mkdir -p /tmp/nginx/body && chmod -R 777 /tmp/nginx

# Expõe a porta (Render detecta via $PORT)
EXPOSE 8080

COPY . /var/www

# Executa entrypoint
CMD ["/entrypoint.sh"]
