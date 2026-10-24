FROM php:8.3-apache

# 1. Install system dependencies & PostgreSQL / MySQL client libraries
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 3. Configure Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy application files
COPY . .

# 7. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 8. Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Startup script to handle dynamic PORT on Render.com
RUN echo '#!/bin/sh\n\
PORT="${PORT:-80}"\n\
sed -ri -e "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf\n\
sed -ri -e "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf\n\
php artisan storage:link || true\n\
php artisan config:cache || true\n\
php artisan route:cache || true\n\
php artisan view:cache || true\n\
exec apache2-foreground' > /usr/local/bin/start-app.sh \
    && chmod +x /usr/local/bin/start-app.sh

EXPOSE 80

CMD ["/usr/local/bin/start-app.sh"]
