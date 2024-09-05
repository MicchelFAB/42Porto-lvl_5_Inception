FROM debian:oldstable

ARG SQL_DB=;
ARG SQL_USR=;
ARG SQL_PASS=;
ARG SQL_HOST=;
ARG WP_URL=;
ARG WP_TITLE=;
ARG WP_USER=;
ARG WP_EMAIL=;
ARG WP_PASS=;
ARG WP_ADM_USR=;
ARG WP_ADM_EML=;
ARG WP_ADM_PASS=;

RUN 	apt update && \
		apt upgrade -y && \
		apt install -y wget php7.4 \
			php-fpm php-mysql \
			mariadb-client && \
		apt autoremove -y

RUN		mkdir -p /run/php
RUN 	chmod -R 755 /run/php

COPY conf/www.conf /etc/php/7.4/fpm/pool.d/
COPY tools/wp-script.sh /wp-script.sh
RUN chmod +x /wp-script.sh

ENTRYPOINT  ["/wp-script.sh"]

EXPOSE  9000

CMD ["/usr/sbin/php-fpm7.4", "-F"]