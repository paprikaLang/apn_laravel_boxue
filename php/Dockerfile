FROM ubuntu:18.04

LABEL maintainer="Mars <11@boxue.io>"
LABEL description="Docker container for server side development."

# Install Laravel dependencies
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
        mysql-client \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        libbz2-dev \
        libcurl4-openssl-dev \
        php7.2 \
        php7.2-fpm \
        php7.2-mbstring \
        php7.2-zip \
        php7.2-xml \
        php7.2-sqlite3 \
        php-mysql \
        php-xdebug \
        php-curl \
        wget \
        curl \
        sqlite3 \
        net-tools \
        cron \
        redis \
        screen \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install composer
COPY ./install-composer.sh /tmp
RUN chmod +x /tmp/install-composer.sh \
        && /tmp/install-composer.sh --install-dir=/usr/local/bin \
        && mv /usr/local/bin/composer.phar /usr/local/bin/composer \
        && mkdir /run/php

# Delete default php-fpm config
RUN sed -i '/listen = \/run\/php\/php7\.2-fpm\.sock/d' /etc/php/7.2/fpm/pool.d/www.conf \
    && sed -i '/^;date\.timezone =/d' /etc/php/7.2/fpm/php.ini \
    && sed -i '/^display_errors = stderr/d' /etc/php/7.2/fpm/php.ini

# The new config
RUN echo 'listen = php:9000' >> /etc/php/7.2/fpm/pool.d/www.conf \
    && echo 'date.timezone = Asia/Shanghai' >> /etc/php/7.2/fpm/php.ini \
    && echo 'display_errors = stderr' >> /etc/php/7.2/fpm/php.ini

RUN ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# XDebug config
COPY ./xdebug.ini /etc/php/7.2/mods-available/

CMD ["php-fpm7.2", "-F"]
