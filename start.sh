#!/bin/sh
mkdir -p /var/log/nginx
mkdir -p /var/cache/nginx
nginx -c /app/nginx.conf
php-fpm -y /app/fpm.conf -F
