#!/bin/sh
cp .env.example .env
npm run build
php artisan key:generate
php artisan migrate