FROM php:8.0-apache

WORKDIR /var/www/html

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    && docker-php-ext-install mbstring zip gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

# Apache configuration
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf
RUN echo "ServerName treevitae.onrender.com" >> /etc/apache2/apache2.conf
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks MultiViews\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Configure Apache DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf

# Production PHP settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Set permissions
RUN chown -R www-data:www-data /var/www/html