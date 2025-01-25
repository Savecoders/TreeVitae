FROM php:8.0-apache

WORKDIR /var/www/html

# Install only required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    && docker-php-ext-install mbstring zip gd \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

# Production PHP settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"