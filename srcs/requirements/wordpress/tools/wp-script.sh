#!/bin/sh

# Wait for MariaDB to be ready
until mysqladmin ping -h "${SQL_HOST}" --silent; do
    echo "Waiting for MariaDB to be ready..."
    sleep 2
done

# Check if WordPress is already installed
if [ ! -f /var/www/html/wp-config.php ]; then
    # Download WordPress
    wget https://pt.wordpress.org/wordpress-5.7.8-pt_PT.tar.gz
    tar -xzvf wordpress-5.7.8-pt_PT.tar.gz
    cp -r wordpress/* /var/www/html/
    rm -rf wordpress
    rm wordpress-5.7.8-pt_PT.tar.gz

    # Create wp-config.php
    cp /var/www/html/wp-config-sample.php /var/www/html/wp-config.php

    # Configure wp-config.php
    sed -i "s/username_here/${SQL_USR}/g" /var/www/html/wp-config.php
    sed -i "s/password_here/${SQL_PASS}/g" /var/www/html/wp-config.php
    sed -i "s/localhost/${SQL_HOST}/g" /var/www/html/wp-config.php
    sed -i "s/database_name_here/${SQL_DB}/g" /var/www/html/wp-config.php

    # Download and install WP-CLI
    wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    mv wp-cli.phar /usr/local/bin/wp

    chown -R www-data:www-data /var/www/html
    find /var/www/html -type d -exec chmod 755 {} \;
    find /var/www/html -type f -exec chmod 644 {} \;

    # Install WordPress
    wp core install \
        --path=/var/www/html \
        --url=${WP_URL} \
        --title=${WP_TITLE} \
        --admin_user=${WP_ADM_USR} \
        --admin_password=${WP_ADM_PASS} \
        --admin_email=${WP_ADM_EML} \
        --allow-root

    # Create a new user
    wp user create \
        --dbname=$SQL_DB \
        --dbuser=$SQL_USR \
        --dbpass=$SQL_PASS \
        --dbhost=$SQL_HOST \
        --path=/var/www/html \
        --allow-root
fi

exec "$@"
