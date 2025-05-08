FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    git \
    && docker-php-ext-install pdo \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory and copy app files
WORKDIR /var/www/html/
COPY . /var/www/html/

# Install PHP dependencies
RUN composer install

EXPOSE 80
