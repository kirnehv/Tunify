# Pull nginx base image
FROM nginx:latest as tunify-web

# Expost port 80
EXPOSE 80

# Copy static assets into var/www
COPY ./* /usr/share/nginx/html/

# Start up nginx server
CMD ["nginx"]
