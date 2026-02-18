# Utilise l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les extensions PHP nécessaires pour MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active le module Apache rewrite (pour les URLs propres)
RUN a2enmod rewrite

# Installe des outils supplémentaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Installe Composer (gestionnaire de dépendances PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le répertoire de travail
WORKDIR /var/www/html

# Copie les fichiers de l'application
COPY ./app /var/www/html

# Donne les permissions appropriées
RUN chown -R www-data:www-data /var/www/html

# Expose le port 80
EXPOSE 80
