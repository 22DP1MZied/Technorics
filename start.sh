#!/bin/sh
nginx
php-fpm -y /app/fpm.conf -F
