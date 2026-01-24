FROM php:8.2-apache

# 1. Enable Apache rewrite for MVC routing
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Set working directory
WORKDIR /var/www/html

RUN mkdir -p storage/cache && \
    chown -R www-data:www-data storage && \
    chmod -R 775 storage/cache

# 6. Apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf