FROM nginx:stable-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN addgroup -g ${GID} --system lumen
RUN adduser -G lumen --system -D -s /bin/sh -u ${UID} lumen
RUN sed -i "s/user  nginx/user lumen/g" /etc/nginx/nginx.conf

ADD ./nginx/default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/html