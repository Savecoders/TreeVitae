FROM php:8.0-apache

WORKDIR /var/www/html

# System updates and required libraries
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    sendmail \
    && docker-php-ext-install mysqli pdo_mysql mbstring zip gd \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite

# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Configure VirtualHost
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html/>\n\
        Options FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
        DirectoryIndex index.php index.html\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/