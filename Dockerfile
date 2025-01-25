FROM php:8.0-apache

WORKDIR /var/www/html

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    && docker-php-ext-install mbstring zip gd \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

# Copy Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Production PHP settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html