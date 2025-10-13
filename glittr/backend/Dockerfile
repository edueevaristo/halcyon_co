FROM php:8.3-fpm

ARG user=halcyon
ARG uid=1000

# Instalar dependências do sistema + nginx
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets fileinfo mysqli

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar usuário
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

WORKDIR /var/www

# Copiar configurações personalizadas do PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Copiar configuração do nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Expor a porta (Render usa $PORT)
EXPOSE 8080

# Comando para iniciar o PHP-FPM + Nginx
CMD service php8.3-fpm start && nginx -g 'daemon off;'

USER $user
