#!/bin/bash

# Wait until MySQL is ready
echo "⏳ Waiting for MySQL at $DB_HOST:$DB_PORT..."
until nc -z "$DB_HOST" "$DB_PORT"; do
  sleep 2
done

echo "✅ MySQL is up - running migrations"
php artisan migrate --force

# Start Laravel dev server
php artisan serve --host=0.0.0.0 --port=8000
