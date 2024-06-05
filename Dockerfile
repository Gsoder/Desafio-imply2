FROM php:8.1-cli

COPY . /var/www/html

COPY 90-xdebug.ini "${PHP_INI_DIR}/conf.d"

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

EXPOSE 80

CMD ["apache2-foreground"]
