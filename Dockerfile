# Use PHP 8.3 with FPM
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy existing backend files
COPY . .

# Install Laravel dependencies
RUN composer install --no-interaction

# Generate app key
RUN php artisan key:generate

# Expose port 8000
EXPOSE 8000

# Serve the app
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]