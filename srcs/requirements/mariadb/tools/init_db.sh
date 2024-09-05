#!/bin/sh

# Start MariaDB and wait for it to fully start
service mariadb start
sleep 10

# Ensure MariaDB is started by checking its status
mysqladmin ping -hlocalhost --silent

# Create database
mysql -e "CREATE DATABASE IF NOT EXISTS \`${SQL_DB}\`;"

# Create user and grant privileges
mysql -e "CREATE USER IF NOT EXISTS \`${SQL_USR}\`@'%' IDENTIFIED BY '${SQL_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON \`${SQL_DB}\`.* TO \`${SQL_USR}\`@'%' IDENTIFIED BY '${SQL_PASS}';"

# Flush privileges
mysql -e "FLUSH PRIVILEGES;"

# Modify root user password
mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '${SQL_ROOT_PASS}';"

# Shutdown MariaDB to apply changes
mysqladmin -u root -p${SQL_ROOT_PASS} shutdown
sleep 10

# Start MariaDB in safe mode
exec mysqld_safe
