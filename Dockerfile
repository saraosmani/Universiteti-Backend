# Use PHP 8.3 FPM
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Disable OPcache to avoid errors
RUN { \
    echo 'opcache.enable=0'; \
    echo 'opcache.enable_cli=0'; \
    } >> /usr/local/etc/php/conf.d/opcache.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy backend code
COPY . .

# Composer unlimited memory
ENV COMPOSER_MEMORY_LIMIT=-1

# Install Laravel dependencies
RUN composer install --no-interaction

# Generate Laravel app key
RUN php artisan key:generate

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]