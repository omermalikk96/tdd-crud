FROM ubuntu:20.04

WORKDIR /var/www

RUN apt-get update

RUN apt-get -y install ca-certificates apt-transport-https software-properties-common 

RUN add-apt-repository ppa:ondrej/php

RUN apt-get update

RUN apt-get install php8.0-fpm nginx -y

RUN apt-get install supervisor php8.0-curl php8.0-pdo php8.0-pdo-mysql php8.0-mysql php8.0-gd php8.0-imagick php8.0-cli php8.0-dev php8.0-imap php8.0-mbstring php8.0-opcache php8.0-soap php8.0-zip php8.0-intl mysql-client git -y

RUN apt-get install zip unzip php8.0-zip -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
COPY composer*.json ./

COPY composer*.lock ./

COPY ./docker/entrypoint.sh /etc/entrypoint.sh

RUN chmod +x /etc/entrypoint.sh

EXPOSE 80 443

ENTRYPOINT ["sh","/etc/entrypoint.sh"]