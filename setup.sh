#!/bin/sh
cp .env.example .envnpm run build
php artisan key:generate
php artisan migrate