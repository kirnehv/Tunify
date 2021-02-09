FROM nginx as tunify-web
COPY nginx.conf /etc/nginx/nginx.conf

FROM php:7-fpm as tunify-php
RUN docker-php-ext-install mysqli
