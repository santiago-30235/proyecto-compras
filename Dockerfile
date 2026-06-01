FROM php:8.3-apache

# Dependencias base
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Laravel deps
RUN composer install --no-dev --optimize-autoloader

# 🔥 IMPORTANTE: limpiar node_modules antes de instalar
RUN rm -rf node_modules package-lock.json

# Frontend deps + build
RUN npm install
RUN npm run build

# Permisos Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache rewrite
RUN a2enmod rewrite

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]