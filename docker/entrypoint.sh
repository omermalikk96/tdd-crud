#!/usr/bin/env bash
composer install --ignore-platform-reqs

chown -R www-data:www-data /var/www

echo "Docker Container is running Successfully" 

service php8.0-fpm start

update-alternatives --set php /usr/bin/php8.0

apt-get install php8.0-dom

nginx -g 'daemon off;'

