#!/bin/bash

echo "=== Setting up Laravel Docker project ==="

# Copy environment file
cp .env.example .env

# Start containers
docker-compose up -d --build

# Wait for MySQL to be ready
echo "=== Waiting for MySQL... ==="
sleep 10

# Install dependencies
docker exec -it php-laravel composer install

# Generate key
docker exec -it php-laravel php artisan key:generate

# Fix permissions
docker exec -it php-laravel chown -R www-data:www-data storage bootstrap/cache

# Run migrations
docker exec -it php-laravel php artisan migrate

# Clear caches
docker exec -it php-laravel php artisan config:clear
docker exec -it php-laravel php artisan cache:clear

echo "=== Done! Visit http://localhost:8000 ==="