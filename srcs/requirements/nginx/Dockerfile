FROM debian:bullseye

RUN 	apt update && \
		apt upgrade -y && \
		apt autoremove && \
		apt install -y nginx \ 
			nano curl openssl

RUN 	mkdir -p /etc/nginx/ssl \
			 /var/run/nginx

RUN 	openssl req -x509 -nodes -out /etc/nginx/ssl/inception.crt -keyout  \
			/etc/nginx/ssl/inception.key -subj \
			"/C=PT/ST=Porto/L=Porto/O=42/OU=42/CN=mamaral-.42.fr/UID=mamaral-"

COPY	conf/nginx.conf /etc/nginx/nginx.conf
COPY	conf/default.conf /etc/nginx/sites-available/default.conf

RUN		chmod 755 /var/www/html
RUN		chown -R www-data:www-data /var/www/html

CMD [ "nginx", "-g", "daemon off;" ]