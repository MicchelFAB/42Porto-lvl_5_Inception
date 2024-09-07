FROM debian:oldstable

ARG SQL_DB
ARG SQL_USR
ARG SQL_PASS
ARG SQL_ROOT_PASS

RUN apt update && \
    apt upgrade -y && \
    apt install -y mariadb-server && \
    apt autoremove -y

COPY conf/50-server.cnf /etc/mysql/mariadb.conf.d/
COPY tools/ /tools/

RUN chmod +x /tools/init_db.sh

# Set environment variables
ENV MYSQL_DATABASE=${SQL_DB}
ENV MYSQL_USER=${SQL_USR}
ENV MYSQL_PASSWORD=${SQL_PASS}
ENV MYSQL_ROOT_PASSWORD=${SQL_ROOT_PASS}

EXPOSE 3306

# Initialize the database
CMD ["/tools/init_db.sh"]
