# Pull nginx base image
FROM nginx

# Copy files
COPY nginx.conf /etc/nginx/nginx.conf
COPY . /usr/share/nginx/html
