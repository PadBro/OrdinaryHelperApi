FROM php:8.3.7-alpine3.18

ENV APP_NAME=Laravel
ENV APP_ENV=local
ENV APP_KEY=base64:8wFcMBZ3MKeEBvKikQlrUf5xAfGXxbttRs7I/wKLqxU=
ENV APP_DEBUG=true
ENV APP_TIMEZONE=UTC
ENV APP_URL=http://localhost

ENV APP_LOCALE=en
ENV APP_FALLBACK_LOCALE=en
ENV APP_FAKER_LOCALE=en_US

ENV APP_MAINTENANCE_DRIVER=file
ENV # APP_MAINTENANCE_STORE=database

ENV PHP_CLI_SERVER_WORKERS=4

ENV BCRYPT_ROUNDS=12

ENV LOG_CHANNEL=stack
ENV LOG_STACK=single
ENV LOG_DEPRECATIONS_CHANNEL=null
ENV LOG_LEVEL=debug

ENV DB_CONNECTION=mariadb
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=ordinaryhelperapi
ENV DB_USERNAME=root
ENV DB_PASSWORD=root

ENV SESSION_DRIVER=database
ENV SESSION_LIFETIME=120
ENV SESSION_ENCRYPT=false
ENV SESSION_PATH=/
ENV SESSION_DOMAIN=null

ENV BROADCAST_CONNECTION=log
ENV FILESYSTEM_DISK=local
ENV QUEUE_CONNECTION=database

ENV CACHE_STORE=database
ENV CACHE_PREFIX=

ENV MEMCACHED_HOST=127.0.0.1

ENV REDIS_CLIENT=phpredis
ENV REDIS_HOST=127.0.0.1
ENV REDIS_PASSWORD=null
ENV REDIS_PORT=6379

ENV MAIL_MAILER=log
ENV MAIL_HOST=127.0.0.1
ENV MAIL_PORT=2525
ENV MAIL_USERNAME=null
ENV MAIL_PASSWORD=null
ENV MAIL_ENCRYPTION=null
ENV MAIL_FROM_ADDRESS="hello@example.com"
ENV MAIL_FROM_NAME="${APP_NAME}"

ENV AWS_ACCESS_KEY_ID=
ENV AWS_SECRET_ACCESS_KEY=
ENV AWS_DEFAULT_REGION=us-east-1
ENV AWS_BUCKET=
ENV AWS_USE_PATH_STYLE_ENDPOINT=false

ENV VITE_APP_NAME="${APP_NAME}"

RUN docker-php-ext-install pdo pdo_mysql

# ARG COMPOSER_VERSION=2.7.4
# ARG XDEBUG_VERSION=3.3.2

# RUN apk add --no-cache \
#     linux-headers \
#     autoconf g++ make \
#     libpng-dev \
#     libjpeg-turbo-dev \
#     libwebp-dev \
#     postgresql-client \
#     postgresql-dev \
#     libzip-dev \
#     imap-dev \
#     dovecot \
#     shadow \
#     icu-data-full \
#     && \
#     NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
#     docker-php-ext-configure gd --with-webp --with-jpeg && \
#     docker-php-ext-install -j${NPROC} \
#         pdo_pgsql  \
#         bcmath  \
#         intl \
#         gd \
#         calendar \
#         zip \
#         imap \
#         pcntl \
#         && \
#     pecl install xdebug-${XDEBUG_VERSION} && \
#     pecl install redis openswoole && \
#     docker-php-ext-enable redis openswoole && \
#     apk del autoconf g++ make && \
#     rm -rf /usr/share/man /tmp/* /var/cache/apk/* /tmp/pear && \
#     sed -i 's|www-data:/sbin/nologin|www-data:/bin/sh|g' /etc/passwd

# install composer
# RUN curl https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar \
#     > /usr/local/bin/composer && \
#     chmod +x /usr/local/bin/composer

WORKDIR /app
COPY . /app

CMD php artisan serve --host=0.0.0.0 --port=8181
