When you move it next, convert it to a composer project. Instructions here- https://roots.io/using-composer-with-wordpress/ Best example is at the bottom.

Otherwise- bad install instructions:


sudo mkdir wordpress custom
sudo chown -R www-data:www-data wordpress/ custom/
sudo chmod g+w wordpress/ custom/
git clone git@github.com:wkstar/iTee-Systems.git custom/
git clone git@github.com:wkstar/WordPress.git wordpress/
cd wordpress
git checkout 4.3-branch
cd ..
cp -R custom/* wordpress/
mv wordpress/ wp-itee

mysql -h c91ed08e7e4090ed9ddfc2dda89841d226b6a028.rackspaceclouddb.com wp-itee -u iteeuser -p < custom/scripts/db122973_wp_itee.sql
vim wordpress/wp-config.php

# $table_prefix  = 'wp_itee';

# regenerate permalinks - make sure htaccess is enabled


You may have to disable wp-content/plugings/ security/password to get into the backend.


You need to clear cache of custom-content-type-manager before you can edit content.
