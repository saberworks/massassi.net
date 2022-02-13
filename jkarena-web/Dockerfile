FROM php:7.4-apache

WORKDIR /home/jkarena

ARG APP_USER=jkarena
RUN groupadd -r ${APP_USER} && useradd --no-log-init -r -g ${APP_USER} ${APP_USER}

RUN apt update \
    && apt -y upgrade \
    && apt -y install vim

COPY ./apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY ./php-overrides.ini /usr/local/etc/php/conf.d/

COPY public ./public

RUN chown -R ${APP_USER}:${APP_USER} /home/jkarena

USER ${APP_USER}:${APP_USER}
