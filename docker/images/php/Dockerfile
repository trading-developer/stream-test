FROM php:8.0-fpm

RUN mkdir -p /var/www

RUN apt-get update && apt-get install -y \
        curl \
        libpq-dev \
        libicu-dev \
        libzip-dev \
        zip \
        git && \
    docker-php-ext-install -j$(nproc) iconv pdo pdo_pgsql pgsql bcmath intl zip && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql  && \
    docker-php-ext-enable pdo_pgsql && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR /var/www/app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]