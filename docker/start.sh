#!/bin/sh
set -e

echo "🔧 Aguardando banco de dados..."

until php artisan migrate --force; do
  echo "⚠️ Banco de dados ainda indisponível... tentando de novo em 5s"
  sleep 5
done

echo "✅ Banco pronto! Iniciando servidor..."

exec php-fpm
