#!/bin/bash

echo "==> Atualizando repositório..."
git pull origin main

echo "==> Parando containers antigos..."
docker compose down --volumes --remove-orphans

echo "==> Buildando containers (sem cache)..."
docker compose build --no-cache

echo "==> Limpando imagens não utilizadas atualmente por containers..."
docker image prune -a --force

echo "==> Subindo containers atualizados..."
docker compose up -d --remove-orphans

# echo "==> Aguardando banco de dados ficar pronto..."
# sleep 30

echo "==> Instala dependencias via composer..."
docker exec f12-rifas composer install --no-dev --optimize-autoloader

echo "==> Instala dependencias via npm..."
docker exec f12-rifas npm ci --omit=dev

echo "==> Builda dependencias via npm..."
docker exec f12-rifas npm run build

echo "==> Executando migrations do Laravel..."
docker exec f12-rifas php artisan migrate --force

echo "✅ Deploy finalizado com sucesso!"
