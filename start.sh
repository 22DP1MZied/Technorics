#!/bin/sh
adduser -D -u 1000 appuser 2>/dev/null || true
nginx
php-fpm -y /app/fpm.conf -F
