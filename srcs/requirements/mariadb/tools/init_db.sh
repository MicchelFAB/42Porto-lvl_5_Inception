#!/bin/sh

# Start MariaDB safely in the background
mysqld_safe &
sleep 10

# Wait until MariaDB is fully started
until mysqladmin ping -h "localhost" --silent; do
    echo "Waiting for MariaDB to start..."
    sleep 2
done

# Create the database
mysql -u root -p"${SQL_ROOT_PASS}" -e "CREATE DATABASE IF NOT EXISTS \`${SQL_DB}\`;"

# Create a new user and grant privileges
mysql -u root -p"${SQL_ROOT_PASS}" -e "CREATE USER IF NOT EXISTS \`${SQL_USR}\`@'%' IDENTIFIED BY '${SQL_PASS}';"
mysql -u root -p"${SQL_ROOT_PASS}" -e "GRANT ALL PRIVILEGES ON \`${SQL_DB}\`.* TO \`${SQL_USR}\`@'%';"

# Flush privileges to ensure changes are applied
mysql -u root -p"${SQL_ROOT_PASS}" -e "FLUSH PRIVILEGES;"

# Modify root user password
mysql -u root -p"${SQL_ROOT_PASS}" -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '${SQL_ROOT_PASS}';"

# Shutdown MariaDB to apply changes and restart in safe mode
mysqladmin -u root -p"${SQL_ROOT_PASS}" shutdown
sleep 5

# Start MariaDB in safe mode
exec mysqld_safe
