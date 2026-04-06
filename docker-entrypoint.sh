#!/bin/bash

# Exit on error
set -e

echo "🔄 Waiting for database to be ready..."

# Wait for database connection
until php artisan db:show 2>/dev/null; do
    echo "⏳ Database is unavailable - waiting..."
    sleep 2
done

echo "✅ Database is ready!"

# Run migrations
echo "🔄 Running database migrations..."
php artisan migrate --force

echo "✅ Migrations completed!"

# Start PHP-FPM
echo "🚀 Starting PHP-FPM..."
exec php-fpm
