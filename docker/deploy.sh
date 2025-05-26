#!/bin/bash

echo "==> Atualizando repositório..."
git pull origin main

echo "==> Gerencia containers..."
docker compose down --volumes --remove-orphans
docker compose build --no-cache
docker image prune --force
docker compose up -d --remove-orphans

echo "==> Instala dependencias via composer..."
docker exec f12-rifas composer install --no-dev --optimize-autoloader

echo "==> Instala dependencias via npm..."
docker exec f12-rifas npm ci
docker exec f12-rifas npm run build
docker exec f12-rifas npm prune --omit=dev

echo "==> Instala configurações do laravel..."
docker exec f12-rifas php artisan migrate --force
docker exec f12-rifas php artisan key:generate

# docker exec -it f12-rifas php artisan route:clear
# docker exec -it f12-rifas php artisan config:clear
# docker exec -it f12-rifas php artisan cache:clear
# docker exec -it f12-rifas php artisan view:clear
# docker exec -it f12-rifas php artisan optimize:clear

# docker exec -it f12-rifas php artisan config:cache
# docker exec -it f12-rifas php artisan route:cache
# docker exec -it f12-rifas php artisan view:cache
# docker exec -it f12-rifas php artisan optimize
