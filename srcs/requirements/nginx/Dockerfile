FROM debian:oldstable

RUN 	apt update && \
		apt upgrade -y && \
		apt install -y nginx \ 
			nano curl openssl && \
		apt autoremove -y

RUN 	mkdir -p /etc/nginx/ssl \
			 /var/run/nginx

RUN 	openssl req -x509 -nodes -out /etc/nginx/ssl/mamaral.crt -keyout  \
			/etc/nginx/ssl/mamaral.key -subj \
			"/C=PT/ST=Porto/L=Porto/O=42/OU=42/CN=mamaral-.42.fr/UID=mamaral-"

COPY	conf/nginx.conf /etc/nginx/sites-available/default

RUN		chmod 755 /var/www/html
RUN		chown -R www-data:www-data /var/www/html

CMD [ "nginx", "-g", "daemon off;" ]