#!/bin/sh
set -e

php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Commands above run as root and re-create files under storage/ and
# bootstrap/cache/ owned by root. php-fpm workers run as www-data, so
# restore ownership before handing off to nginx/php-fpm.
chown -R www-data:www-data storage bootstrap/cache

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
