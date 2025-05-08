FROM php:8.2-apache

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    git \
    && docker-php-ext-install pdo \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy only composer files first to leverage Docker caching
COPY composer.json /var/www/html/
WORKDIR /var/www/html/
RUN composer install

# Copy all source files
COPY . /var/www/html/

EXPOSE 80
