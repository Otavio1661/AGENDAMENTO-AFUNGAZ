FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    locales \
    wget \
    git \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libfreetype6-dev \
    unzip \
    zlib1g-dev \
    libaio1 \
    freetds-bin \
    freetds-dev \
	freetds-common \ 
    libsybdb5 && \
    ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/ && \
    docker-php-ext-install pdo pdo_dblib && \
    docker-php-ext-configure pdo_dblib --with-libdir=lib/x86_64-linux-gnu \
    && apt-get clean

RUN docker-php-ext-install intl mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y bash

# Gerar locale PT-BR
RUN echo "pt_BR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen "pt_BR.UTF-8" && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG="pt_BR.UTF-8"

# Definir fuso horário para America/Sao_Paulo
RUN ln -fs /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata


# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Install GD
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install gd

# rewrite
RUN a2enmod rewrite

#composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

COPY . /var/www/html

WORKDIR /var/www/html

RUN mkdir -p logs
RUN chmod -R 777 logs

RUN composer install --ignore-platform-reqs

# DataDog
RUN wget https://github.com/DataDog/dd-trace-php/releases/latest/download/datadog-setup.php -O datadog-setup.php
RUN php datadog-setup.php --php-bin all

# Sockets
RUN docker-php-ext-install sockets

# AddDefaultCharset UTF-8
RUN echo "AddDefaultCharset UTF-8" >> /etc/apache2/apache2.conf

# Bcmath
RUN docker-php-ext-install bcmath

RUN rm /usr/local/etc/php/php*

ADD .docker/php/php.ini /usr/local/etc/php/php.ini

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo "xdebug.mode= develop,debug,coverage" >> "/usr/local/etc/php/conf.d/xdebug.ini" \
&& echo "xdebug.log = '/tmp/xdebug.log'" >> "/usr/local/etc/php/conf.d/xdebug.ini" \
&& echo "xdebug.client_port= 9000" >> "/usr/local/etc/php/conf.d/xdebug.ini" \
&& echo "xdebug.client_host = host.docker.internal" >> "/usr/local/etc/php/conf.d/xdebug.ini" \
&& echo "xdebug.start_with_request= yes" >> "/usr/local/etc/php/conf.d/xdebug.ini"

EXPOSE 80