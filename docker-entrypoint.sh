#!/bin/sh
set -e

# 0. Bersihkan cache config lama (PENTING, biar tidak pakai config basi)
php artisan config:clear

# 1. Jalankan migration database
php artisan migrate --force

# 2. Optimasi performa API di production
php artisan config:cache
php artisan route:cache

# 3. Jalankan PHP-FPM di background
php-fpm -D

# 4. Jalankan Nginx di foreground
nginx -g "daemon off;"
