FROM php:8.3-fpm AS base

#RUN mkdir -p /var/www/backend

WORKDIR /var/www/backend

ARG UID
ARG GID
ARG UNAME

RUN apt update

RUN apt install -y nano libxml2-dev sudo nodejs npm

# php
RUN apt install -y libicu-dev
RUN apt install -y libonig-dev
RUN apt install -y libzip-dev
RUN apt install -y libpng-dev
RUN apt install -y libpq-dev
RUN apt install -y libjpeg-dev
RUN apt install -y zlib1g-dev
RUN apt install -y libfreetype6-dev
RUN apt install -y libjpeg62-turbo-dev
RUN apt install -y libwebp-dev
RUN apt install -y zip
RUN apt install -y unzip
RUN apt install -y git
RUN apt install -y mariadb-client
RUN apt install -y libmagickwand-dev
RUN apt install -y libmagickcore-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install exif

RUN docker-php-ext-enable  \
    intl  \
    mbstring  \
    zip  \
    pdo \
    pdo_mysql  \
    pcntl  \
    gd  \
    mysqli \
    exif

# Debugger
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN groupadd --gid ${GID} ${UNAME} \
    && useradd --home-dir "/home/${UNAME}" --create-home --uid ${UID} \
    --gid ${GID} --shell /bin/bash --skel /dev/null ${UNAME}

RUN echo "${UNAME} ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
RUN usermod -a -G wwwdata ${UNAME}

COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer
RUN composer config --global repo.packagist composer https://packagist.org

COPY ./backend/ .

COPY ./docker/php/entrypoint.sh /entrypoint.sh

USER ${UNAME}

ENTRYPOINT ["/entrypoint.sh"]
