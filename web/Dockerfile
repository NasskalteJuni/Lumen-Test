FROM php:8.0-apache

RUN a2enmod rewrite
RUN apt-get update && apt-get install -y git unzip zip

COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# install php extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache

# add composer to install dependencies
COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer