FROM php:8.1.18-apache-buster

#RUN echo "Europe/Berlin" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata
ENV APACHE_DOCUMENT_ROOT /var/www/wp

# Install OS utilities and other software
RUN apt-get upgrade -y
RUN apt-get update -y
RUN apt-get -y install \
    dirmngr \ 
    lsb-release \
    ca-certificates \
    apt-transport-https \
    gnupg \ 
    gosu \ 
    curl \
    iputils-ping \
    net-tools \
    git \
    libxml2-dev \
    libonig-dev \
    libpng-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    libzip-dev \ 
    libtidy-dev \
    libcap2-bin \
    zip \
    unzip \
    wget \
    nano


RUN apt clean
RUN apt-get clean
RUN apt-get update

# Generate self-signed certificate
# RUN openssl req -x509 -new -out tailorer-self-signed.crt -keyout tailorer-self-signed.key -days 365 -newkey rsa:4096 -sha256 -nodes << END_SESSION \
# '' \
# '' \
# '' \
# '' \
# '' \
# 'dev.tailorer.se' \
# '' \
# END_SESSION
# Generate self-signed certificate
RUN openssl req -x509 -nodes -days 365 \
    -subj  "/C=CA/ST=QC/O=Company/CN=dev.tailorer.se" \
    -newkey rsa:4096 -sha256 -keyout /etc/ssl/private/tailorer-self-signed.key \
    -out /etc/ssl/certs/tailorer-self-signed.crt;

# Copy wp
COPY --chown=root:www-data ./dockerfiles/wp /var/www/wp
RUN chmod 774 -R /var/www/wp

# Configure Apache2 / httpd
RUN /usr/sbin/a2enmod rewrite && /usr/sbin/a2enmod headers && /usr/sbin/a2enmod ssl && /usr/sbin/a2enmod expires
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY ./dockerfiles/tailorer.conf /etc/apache2/sites-available/tailorer.conf
COPY ./dockerfiles/tailorer-ssl.conf /etc/apache2/sites-available/tailorer-ssl.conf
RUN /usr/sbin/a2dissite 000-default
RUN /usr/sbin/a2ensite tailorer 
RUN /usr/sbin/a2ensite tailorer-ssl

RUN apt-get update
RUN docker-php-ext-install curl && docker-php-ext-enable curl
RUN docker-php-ext-install gd && docker-php-ext-enable gd
RUN docker-php-ext-install mbstring && docker-php-ext-enable mbstring
RUN docker-php-ext-install xml && docker-php-ext-enable xml
RUN docker-php-ext-install soap && docker-php-ext-enable soap
RUN docker-php-ext-install intl && docker-php-ext-enable intl
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install zip && docker-php-ext-enable zip
RUN docker-php-ext-install exif && docker-php-ext-enable exif
RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

EXPOSE 80:80
EXPOSE 443:443