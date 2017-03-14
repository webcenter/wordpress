#!/bin/bash

# CRIANDO UMA INSTALACAO LIMPA DO WORDPRESS
WORDPRESS_URL="https://wordpress.org/latest.tar.gz"
 
# GET ALL USER INPUT
echo "Nome do Projeto?"
read PROJECT_FOLDER_NAME
 
echo "Pasta localhost (ex: /var/www/html)?"
read PROJECT_SOURCE_URL
 
echo "Criar wp_config? (y/n)"
read SHOULD_SETUP_DB
 
if [ $SHOULD_SETUP_DB = 'y' ]
then
    echo "DB Name"
    read DB_NAME
 
    echo "DB Username"
    read DB_USERNAME
 
    echo "DB Password"
    read DB_PASSWORD
fi
 
#LETS START INSTALLING
echo "Sente e relaxe :) ......"
 
# CREATE PROJECT DIRECTORIES
cd "$PROJECT_SOURCE_URL"
echo "Creating $PROJECT_FOLDER_NAME"
mkdir "$PROJECT_FOLDER_NAME"
cd "$PROJECT_FOLDER_NAME"
 
# DOWNLOAD WORDPRESS
echo "Downloading Wordpress"
curl -O $WORDPRESS_URL
 
# UNZIP WORDPRESS AND REMOVE ARCHIVE FILES
echo "Unzipping Wordpress"
tar -xzf latest.tar.gz
rm -f latest.tar.gz
mv wordpress public_html
cd public_html
rm license.txt
rm readme.html
 
if [ $SHOULD_SETUP_DB = 'y' ]
then
    # SETUP WP CONFIG
    echo "Create wp_config"
    mv wp-config-sample.php wp-config.php
    sed -i.bak "s/database_name_here/$DB_NAME/" wp-config.php
    sed -i.bak "s/username_here/$DB_USERNAME/" wp-config.php
    sed -i.bak "s/password_here/$DB_PASSWORD/" wp-config.php
    rm -f wp-config.php.bak
fi

sed -i "s/\/\* That's all, stop editing! Happy blogging. \*\//define('DISALLOW_FILE_EDIT',true);/g" wp-config.php 

# PERMISSIONS DIRECTORIES
echo "Set permissions folder/files"
# Set all directories permissions to 755
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
chmod -R 775 wp-content
chmod -v 604 .htaccess
chmod 600 index.php

 
# REMOVE DEFAULT PLUGINS AND INSTALL WORDPRESS_PLUGIN_URL
cd wp-content/plugins
echo "Removendo plugins padrão"
rm hello.php
rm -rf akismet
 
# REMOVE DEFAULT THEMES AND INSTALL WORDPRESS_THEME_URL
cd ../themes
echo "Removendo temas padrão"
rm -R -- */
 
echo "All done..."