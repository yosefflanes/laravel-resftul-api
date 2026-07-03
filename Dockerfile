FROM php:8.4-fpm

# Install system dependencies & PHP extensions yang dibutuhkan Laravel 13
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \

# Install ekstensi PHP untuk database dan manipulasi text/gambar
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer versi terbaru
COPY --from=composer:latest /usr/bin/composer  /usr/bin/composer

# Set working directory di dalam container
WORKDIR /var/www

# Copy semua file project Laravel ke dalam container
COPY . .

# Jalankan Composer install untuk merakit vendor Laravel 13
RUN composer install --no-dev --optimize-autoloader

# Atur permissions agar folder storage bisa ditulis oleh web server
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy konfigurasi Nginx
COPY ./nginx.conf /etc/nginx/sites-available/default

# Buka port 80 untuk Render
EXPOSE 80

# Jalankan entrypoint script saat container aktif
CMD sh /var/www/docker-entrypoint.sh
