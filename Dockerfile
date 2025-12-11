FROM php:8.2-fpm

# System packages
RUN apt-get update && apt-get install -y \
    build-essential \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Composer yükle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
