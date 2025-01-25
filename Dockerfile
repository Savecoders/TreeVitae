FROM php:8.0-apache

WORKDIR /var/www/html

# Actualización del sistema y librerías necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    sendmail \
    && docker-php-ext-install mysqli pdo_mysql mbstring zip gd \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite