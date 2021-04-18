FROM php:7.2-apache

RUN apt-get update

# 1. development packages
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    vim \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libreadline-dev \
    libfreetype6-dev \
    libonig-dev\
    g++

# 2. apache configs + document root
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions
#dockerfile
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install PHP extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd

RUN apt-get update \
     && apt-get install -y libzip-dev \
     && docker-php-ext-install zip

RUN docker-php-ext-install \
      intl \
      mbstring \
      pcntl \
      pdo_mysql \
      opcache

RUN docker-php-ext-install exif pcntl bcmath gd

RUN apt-get update && \
    apt-get install -y \
    build-essential \
    apt-transport-https \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

RUN curl -sL https://deb.nodesource.com/setup_15.x | sudo -E bash -
RUN apt-get update && apt-get install -y nodejs

RUN curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
RUN apt-get update && apt-get install -y yarn


# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. we need a user with the same UID/GID with host user
# so when we execute CLI commands, all the host file's ownership remains intact
# otherwise command from inside container will create root-owned files and directories
ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser
