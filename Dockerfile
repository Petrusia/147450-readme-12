FROM php:7.3-apache-stretch

COPY docker/php.ini /usr/local/etc/php/php.ini
COPY . /var/www/html
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
