FROM php:8.2-apache

# PHP eklentileri
RUN docker-php-ext-install pdo pdo_mysql mysqli

# mod_rewrite aktif et ve proje kökünü DocumentRoot yap
RUN a2enmod rewrite && \
    sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf && \
    echo "<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>" >> /etc/apache2/apache2.conf

# Projeyi kopyala
COPY . /var/www/html

# İzinleri düzelt
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# PHP hata gösterme
RUN echo "display_errors=On" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php.ini

EXPOSE 80
CMD ["apache2-foreground"]
