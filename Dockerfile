# Pull nginx base image
FROM nginx

# Copy static assets
COPY . /usr/share/nginx/html
