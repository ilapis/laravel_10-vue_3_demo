ARG REDIS_VERSION
FROM redis:${REDIS_VERSION}-alpine
ENV REDIS_VERSION=${REDIS_VERSION}

RUN apk add --no-cache gettext

COPY redis.conf /usr/local/etc/redis/redis.conf.template

CMD /bin/sh -c "envsubst '\$REDIS_PASSWORD' < /usr/local/etc/redis/redis.conf.template > /usr/local/etc/redis/redis.conf && exec redis-server /usr/local/etc/redis/redis.conf"