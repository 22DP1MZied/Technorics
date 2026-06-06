#!/bin/sh
echo "Starting nginx..."
nginx -t
nginx
echo "Starting php-fpm..."
php-fpm -y /app/fpm.conf -F
