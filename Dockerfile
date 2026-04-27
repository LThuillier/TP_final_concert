FROM php:8.3-cli

# 1. Installation des dépendances système et des extensions PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libssl-dev \
    pkg-config \
    && docker-php-ext-install pdo pdo_mysql zip intl \
    && pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis \
    && rm -rf /var/lib/apt/lists/*

# 2. Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 3. Copie des fichiers et installation des dépendances Laravel
COPY . .

# On s'assure que les permissions sont correctes pour Laravel
RUN chown -R www-data:www-data /var/www/html

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 8000

# 4. Lancement du serveur (TOUJOURS EN DERNIER)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]