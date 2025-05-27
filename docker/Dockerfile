# Usamos la imagen base de PHP con Apache
FROM php:8.2-apache

# Instalamos las dependencias necesarias para MySQLi
RUN apt-get update && apt-get install -y \
    libmariadb-dev-compat libmariadb-dev && \
    docker-php-ext-install mysqli
