FROM php:8.3-fpm

# Install MySQL extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
