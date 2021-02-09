# the different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target


# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact
ARG PHP_VERSION=7.4
ARG NGINX_VERSION=1.17

FROM madnight/docker-alpine-wkhtmltopdf as wkhtmltopdf_image
# "php" stage
FROM php:${PHP_VERSION}-fpm-alpine AS app_php

# persistent / runtime deps
RUN apk add --no-cache \
	acl \
	fcgi \
	file \
	gettext \
	git \
	;

RUN docker-php-ext-install mysqli pdo pdo_mysql

