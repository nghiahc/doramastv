FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    mysql-client \
    sudo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd && \

    # zip, unzip
    apt-get install -y zip unzip && \

    # vim
    apt-get install -y vim && \

    # composer
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \

    #nodejs
    curl -sL https://deb.nodesource.com/setup_8.x | bash && \
    apt-get install -y nodejs && \

    # add user
    useradd -m -s /bin/bash -u 1000 drama

# set timezone
RUN cp /etc/localtime /etc/localtime.org && \
    ln -sf  /usr/share/zoneinfo/America/Mexico_City /etc/localtime


# www.conf
ADD ./www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www
