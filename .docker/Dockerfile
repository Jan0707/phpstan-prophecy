FROM php:7.1-cli

# Install GD
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

# Install ZIP
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Install tools
RUN apt-get update && apt-get install -y \
        git

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

RUN curl -LO https://deployer.org/deployer.phar \
    && mv deployer.phar /usr/local/bin/dep \
    && chmod +x /usr/local/bin/dep
