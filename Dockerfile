FROM php:8.2-apache

# Install MySQL extensions needed by the app
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# Copy all local files to the Apache server root
COPY . /var/www/html/

# Update Apache to listen on Render's dynamic $PORT variable instead of the default 80
CMD sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT:-80}/g" /etc/apache2/sites-available/000-default.conf && \
    docker-php-entrypoint apache2-foreground
