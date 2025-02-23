#!/bin/bash
#выполняется при создании образа
composer install
npm install
npm run build

# Нужен для laravel
sudo chown -R wwwdata:wwwdata /var/www/backend/storage
sudo chown -R wwwdata:wwwdata /var/www/backend/bootstrap/cache

php artisan key:generate
exec "${@-php-fpm}"
