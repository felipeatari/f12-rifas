FROM php:8.4-fpm

LABEL maintainer="F12 Rifas <mr.robot.felipe@gmail.com>"

ARG WWWGROUP=1000
ARG WWWUSER=www-data

# Instala dependências
RUN apt-get update && apt-get install -y \
    nginx curl zip unzip git supervisor sqlite3 libpng-dev libjpeg-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev libjpeg-dev libfreetype6-dev libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria diretórios base
RUN mkdir -p /var/www/html /var/log/supervisor /tmp/nginx/body /tmp/nginx/proxy /var/log/nginx

# Copia configs do nginx e supervisor
COPY nginx/default.conf /etc/nginx/sites-available/default
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Ajusta permissões para nginx
RUN chown -R www-data:www-data /tmp/nginx /var/log/nginx

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia apenas os arquivos do composer primeiro (para usar cache de camadas)
COPY composer.json composer.lock ./

# Instala dependências PHP (somente para produção)
RUN composer install --no-dev --optimize-autoloader

# Agora copia o restante do projeto
COPY . .

# Garante que diretórios críticos existem e com permissões corretas
RUN mkdir -p storage framework/cache framework/sessions framework/views bootstrap/cache \
    && chown -R $WWWUSER:$WWWGROUP storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Dá permissão para todo o projeto
RUN chown -R $WWWUSER:$WWWGROUP /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord"]
