# Utiliser l'image de PHP 8.0
FROM php:8.0-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo_mysql bcmath

# Copier les fichiers de votre projet dans le conteneur Docker
COPY . /var/www/html

# Définir le répertoire de travail pour Apache
WORKDIR /var/www/html/public

# Exposer le port 80 pour accéder à l'application depuis l'extérieur
EXPOSE 80

# Définir les variables d'environnement pour Laravel
ENV APP_NAME=tiket-
ENV APP_ENV=production
ENV APP_KEY=base64:abcdefgh1234567890
ENV APP_DEBUG=false
ENV APP_URL=http://localhost
