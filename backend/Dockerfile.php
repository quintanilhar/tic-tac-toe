FROM php:7.1-fpm-alpine

WORKDIR /var/www

ADD images/php/php.ini /usr/local/etc/php
ADD . /var/www/

RUN mkdir -p /etc/service/php-fpm
ADD images/php/start.sh /etc/service/php-fpm/run
RUN chmod +x /etc/service/php-fpm/run

CMD ["/etc/service/php-fpm/run"]
