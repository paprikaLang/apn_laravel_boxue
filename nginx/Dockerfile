FROM ubuntu:18.04

  LABEL maintainer="Mars <11@boxue.io>"
 LABEL description="Docker container for Swift Vapor development"

  RUN apt-get update && apt-get install nginx vim inetutils-ping -y \
         && apt-get clean \
         && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
         && echo "daemon off;" >> /etc/nginx/nginx.conf

  ADD php-default /etc/nginx/sites-available/default

  RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
      ln -sf /dev/stderr /var/log/nginx/error.log

  CMD ["nginx"]

