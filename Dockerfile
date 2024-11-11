# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala la extensión mysqli
RUN docker-php-ext-install mysqli

# Copia los archivos del proyecto al directorio raíz de Apache
COPY . /var/www/html/

# Asegúrate de que Apache pueda leer y ejecutar los archivos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para que el contenedor esté disponible
EXPOSE 80
