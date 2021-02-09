FROM nginx
COPY nginx.conf /etc/nginx/nginx.conf

FROM php:7-fpm
RUN docker-php-ext-install mysqli
