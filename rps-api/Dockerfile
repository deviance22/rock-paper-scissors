# rps-api/Dockerfile
# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Change current working directory
WORKDIR /var/www

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Copy environment variables
COPY .env.docker .env
# Add user for Laravel application
RUN useradd -m myuser
RUN chown -R myuser:myuser /var/www

# Create SQLite database file
RUN touch /var/www/database/database.sqlite
RUN chmod 664 /var/www/database/database.sqlite
RUN chown -R myuser:myuser /var/www

# Run database migrations and seed
RUN php artisan migrate:reset
RUN php artisan migrate --force


# Switch to non-root user
USER myuser

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
# Expose port 9000 and start php-fpm server
# EXPOSE 9000
# CMD ["php-fpm"]
