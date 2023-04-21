FROM php:8.1-fpm

RUN apt-get update --fix-missing && apt-get install -y curl wget zip unzip git g++ nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libldap2-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install exif intl pdo pdo_mysql gd soap calendar gettext pcntl sockets zip ldap

WORKDIR /usr/share/nginx/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \ docker-php-ext-enable xdebug

RUN groupadd -g 1000 www

RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /

USER www

CMD ["php-fpm"]
