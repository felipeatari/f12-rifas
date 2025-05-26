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

echo "==> Instala dependencias via composer..."
docker exec -it f12-rifas composer install --no-dev --optimize-autoloader

echo "==> Instala dependencias via npm..."
docker exec -it f12-rifas npm ci

echo "==> Builda dependencias via npm..."
docker exec -it f12-rifas npm run build

echo "==> (Opcional) Remove devDependencies após build..."
docker exec -it f12-rifas npm prune --omit=dev

echo "==> Executando migrations do Laravel..."
docker exec -it f12-rifas php artisan migrate --force

echo "✅ Deploy finalizado com sucesso!"
