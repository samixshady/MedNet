# Use PHP 8.4 CLI for artisan serve
FROM php:8.4-cli

# Install system dependencies and Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm install && npm run build

# Ensure build directory has correct permissions
RUN chmod -R 755 /app/public/build

# Set permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/storage \
    && chmod -R 755 /app/bootstrap/cache

# Create database directory if migrations need it
RUN mkdir -p /app/database && \
    touch /app/database/database.sqlite && \
    chown -R www-data:www-data /app/database && \
    chmod -R 775 /app/database

# Don't cache config during build - do it at runtime with correct env vars
# RUN php artisan config:cache && \
#     php artisan route:cache && \
#     php artisan view:cache

# Expose port
EXPOSE 8000

# Start Laravel server with proper setup
CMD php artisan storage:link && \
    php artisan migrate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=8000
