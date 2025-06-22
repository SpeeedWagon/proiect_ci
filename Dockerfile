# Dockerfile for DEVELOPMENT
FROM php:8.2-apache
WORKDIR /var/www/html

# Enable Apache's mod_rewrite
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# Install PHP extensions
RUN docker-php-ext-install gettext intl mysqli pdo pdo_mysql gd zip

# Configure GD
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# We DO NOT copy the application code here. The volume mount in docker-compose will do that.