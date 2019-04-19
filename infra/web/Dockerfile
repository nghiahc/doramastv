FROM nginx:latest

RUN useradd -m -s /bin/bash -u 1000 drama

# set timezone
RUN cp /etc/localtime /etc/localtime.org && \
    ln -sf  /usr/share/zoneinfo/America/Mexico_City /etc/localtime

# nginx.conf
ADD ./nginx.conf /etc/nginx/nginx.conf

ADD ./vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www
