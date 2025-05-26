#!/bin/bash

echo ""
echo "==> 🚀 Atualizando repositório..."
git pull origin main

echo ""
echo "==> 🧹 Limpando containers antigos e preparando ambiente Docker..."
docker compose down --remove-orphans
docker compose build --no-cache
docker image prune --force
docker compose up -d --remove-orphans

echo ""
echo "==> 📦 Instalando dependências PHP (composer)..."
docker exec f12-rifas composer install --no-dev --optimize-autoloader

echo ""
echo "==> 💻 Instalando dependências JavaScript (npm)..."
docker exec f12-rifas npm ci
docker exec f12-rifas npm run build
docker exec f12-rifas npm prune --omit=dev

echo ""
echo "==> 🔒 Colocando app em manutenção..."
docker exec f12-rifas php artisan down

echo ""
echo "==> 🧼 Limpando caches antigos do Laravel..."
docker exec f12-rifas php artisan cache:clear
docker exec f12-rifas php artisan config:clear
docker exec f12-rifas php artisan route:clear
docker exec f12-rifas php artisan view:clear
docker exec f12-rifas php artisan optimize:clear

echo ""
echo "==> ⏳ Aguardando MySQL iniciar..."
until docker exec mysql-prod mysqladmin ping -h "127.0.0.1" --silent; do
  sleep 2
done
echo "==> ✅ MySQL está pronto."

echo ""
echo "==> 🛠️ Executando migrations..."
docker exec f12-rifas php artisan migrate --force

echo ""
echo "==> 🔧 Recriando caches e otimizando aplicação..."
docker exec f12-rifas php artisan config:cache
docker exec f12-rifas php artisan route:cache
docker exec f12-rifas php artisan view:cache
docker exec f12-rifas php artisan optimize

echo ""
echo "==> 🔓 Tirando app de manutenção..."
docker exec f12-rifas php artisan up

echo ""
echo "✅ Deploy finalizado com sucesso!"
