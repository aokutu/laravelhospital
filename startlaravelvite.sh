#!/bin/bash

echo "Starting Laravel development environment..."

# Start Vite in the background
echo "Starting Vite..."
npm run dev &

# Give Vite some time to initialize
sleep 3

# Start Laravel server
echo "Starting Laravel server..."
php artisan serve