#!/bin/sh

# 1. Optimasi performa API di server production
php artisan config:cache
php artisan route:cache

# 2. Jalankan PHP-FPM di background (-D artinya daemon/background)
php-fpm -D

# 3. Jalankan Nginx di foreground agar server terus menyala dan Render tidak mati
nginx -g "daemon off;"
