#!/bin/bash

echo "==> Atualizando repositório..."
git pull origin main

echo "==> Parando containers antigos..."
docker compose down --volumes --remove-orphans

echo "==> Subindo containers atualizados..."
docker compose up -d --remove-orphans

echo "==> Aguardando banco de dados ficar pronto..."
sleep 30

echo "==> Executando migrations do Laravel..."
docker exec f12-rifas php artisan migrate --force

echo "✅ Deploy finalizado com sucesso!"
