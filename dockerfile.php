FROM php:5.6.12-apache

RUN /usr/sbin/a2enmod rewrite

WORKDIR /tmp
RUN /usr/bin/apt-get update && \
    /usr/bin/apt-get -y install git php5-dev php5-mysql gcc libpcre3-dev && \
    /usr/bin/git clone --depth=1 git://github.com/phalcon/cphalcon.git && \
    cd cphalcon/build/ && \
    ./install && \
    /bin/rm -rf /tmp/cphalcon && \
    /usr/bin/apt-get -y remove --purge git php5-dev gcc

WORKDIR /var/www/html
COPY config/php.ini /usr/local/etc/php/
COPY src/ /var/www/html/

CMD ["apache2-foreground"]