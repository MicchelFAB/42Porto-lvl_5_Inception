FROM debian:bullseye

RUN 	apt update && \
		apt upgrade -y && \
		apt autoremove && \
		apt install -y \
		mariadb-server mysql-server

COPY	conf/50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf
COPY 	conf/mariadb.cnf /etc/mysql/mariadb.cnf