# Для начала указываем исходный образ, он будет использован как основа
FROM php:8.2-fpm-buster

ENV ACCEPT_EULA=Y

# устанавливаем дополнительный софт
RUN apt-get update && apt-get install -y \
    libpq-dev libfreetype6-dev libjpeg62-turbo-dev zlib1g-dev libzip-dev libtidy-dev libonig-dev libicu-dev locales \
    libaio1 g++ wget rsync git zip unzip libpng-dev libxrender1 \
    libfontconfig1 fontconfig libfontconfig1-dev apt-transport-https \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) mbstring zip pdo_mysql mysqli gd exif opcache \
    && apt-get clean && rm -rf /var/cache/apk/* && docker-php-source delete


# Set the locale
RUN locale-gen ru_RU.UTF-8
ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

# PHP TOOLS
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && wget http://robo.li/robo.phar \
&& chmod +x robo.phar && mv robo.phar /usr/bin/robo && curl -LO https://deployer.org/deployer.phar \
&& mv deployer.phar /usr/local/bin/dep && chmod +x /usr/local/bin/dep

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
