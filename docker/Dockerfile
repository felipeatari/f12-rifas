FROM php:8.4-fpm

LABEL maintainer="F12 Rifas <mr.robot.felipe@gmail.com>"

ARG WWWGROUP=1000
ARG WWWUSER=www-data

RUN apt-get update && apt-get install -y \
    nginx curl zip unzip git supervisor sqlite3 libpng-dev libjpeg-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev libjpeg-dev libfreetype6-dev libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/html /var/log/supervisor /tmp/nginx/body /tmp/nginx/proxy /var/log/nginx \
    && chown -R www-data:www-data /tmp/nginx /var/log/nginx

COPY nginx/default.conf /etc/nginx/sites-available/default
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

# Copia o código do projeto — assumindo que você montará o volume ou copiará no docker-compose
COPY ../ /var/www/html

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R $WWWUSER:$WWWGROUP /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
