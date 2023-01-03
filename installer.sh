#!/bin/bash
echo "project name? (Ex: KitelyTech Newsroom)"
read humanreadable
echo "project name base Object? (Ex: KTNewsRoom)"
read projectname
echo "prefix or namespace (Ex: ktnr [which would make a ktnr/KTNewsRoom root object in PHP and similar in JS])"
read namespace
echo "port offset? (Ex: 5 means localhost:8005, :8085)"
read portoffset

if [ -z "$humanreadable" ] || [ -z "$projectname" ] || [ -z "$namespace" ] || [ -z "$portoffset" ] 
then echo "Missing required information. Aborted"
exit 1
else
  mkdir site_$projectname
  mkdir site_$projectname/wp-content
  mkdir site_$projectname/wp-content/themes
  git clone git@github.com:zimaben/theme_blocks_starter.git site_$projectname/wp-content/themes/$projectname

fi

if [ $? -eq 0 ] 
then 
  echo "Successfully added Starter Theme"  

  cat > site_$projectname/docker-compose.yml <<EOF
version: "3.9"
    
services:
  db:
    image: mysql:5.7
    volumes:
       - db_data:/var/lib/mysql
       - ./shared_data:/docker-entrypoint-initdb.d
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: somewordpress
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    volumes:
      - ./wp-content:/var/www/html/wp-content
      - ./uploads.ini:/usr/local/etc/php/conf.d/uploads.ini 
    ports:
      - "800$portoffset:80"
    restart: always
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DB_NAME: wordpress
      WORDPRESS_TABLE_PREFIX: wp_
      WORDPRESS_DEBUG: 1
      WORDPRESS_CONFIG_EXTRA:
        define( 'WP_DEBUG_LOG', true );
        define( 'FS_METHOD', 'direct');
        define( 'WP_DEBUG_DISPLAY', 0);
      PHP_ENABLE_OPCACHE: 0

  phpmyadmin:
    depends_on:
      - db
    image: phpmyadmin
    restart: always
    ports:
      - 808$portoffset:80
    environment:
      UPLOAD_LIMIT: 64M

volumes:
  db_data: {}
  wordpress_data: {}
EOF

#create installer

  cat > site_$projectname/installer.php <<EOF
<?php
\$hr = "$humanreadable";
\$pn = "$projectname";
\$pu = "$namespace";

\$files = array(
	'/library/admin/add_fields.php',
	'/library/admin/ajax.php',
	'/library/admin/customize.php',
	'/library/admin/setup/blocks.php',
	'/library/admin/setup/pages.php',
	'/library/admin/setup/posttypes.php',
	'/library/admin/setup/setup.php',
	'/library/admin/setup/taxonomies.php',
	'/library/admin/integrations/ActiveCampaign.php',
	'/library/admin/integrations/ContactForm7.php',
	'/library/admin/integrations/Figma.php',
	'/library/admin/integrations/GoogleAnalytics.php',
	'/library/admin/integrations/GoogleMaps.php',
	'/library/admin/integrations/MailChimp.php',
	'/library/admin/integrations/Slack.php',
	'/library/core/api/endpoints.php',
	'/library/core/methods.php',
	'/library/core/view.php',
	'/theme/template-parts/404.php',
	'/theme/template-parts/page-header.php',
	'/theme/template-parts/page-static-header.php',
	'/theme/template-parts/progressive-header.php',
	'/theme/template-parts/site-header.php',
	'/theme/template-parts/site-footer.php',
  '/theme/template-parts/prefooter.php',
  '/theme/src/js/blocks/simple-cta.js',
  '/page.php',
	'/footer.php',
	'/front-page.php',
	'/functions.php',
	'/header.php',
	'/index.php',
	'/functions.php',
	'/style.css',
	'/package.json',
	'/wp-theme-config.php'
);
\$replacements = array(
	'<!HUMANREADABLE->' => \$hr,
	'<!PLUGINPATH->' => \$pu,
	'<!PLUGINNAME->'=> \$pn
);

function runsetup(\$files, \$replacements, \$pn){
	foreach(\$files as \$file){
		\$path = __DIR__ . '/wp-content/themes/' . \$pn .  \$file;
		foreach(\$replacements as \$key=>\$val){
			if(file_exists(\$path)){
				\$writable = ( is_writable(\$path) ) ? TRUE : chmod(\$path, 0775);
				if ( \$writable ) {
						\$target = file_get_contents(\$path);
						\$content = preg_replace('/' . \$key . '/s',\$val,\$target);
				    file_put_contents(\$path, \$content);
				} else {
				    echo 'Failed to overwrite ' . \$path . PHP_EOL;
				}
			}
		}
	}
	#include('wp-load.php');
}
runsetup(\$files, \$replacements, \$pn);
EOF
PHP=`which php`
$PHP site_$projectname/installer.php
else 
  echo "Could not download Starter Theme" >&2 
fi

if [ $? -eq 0 ] 
then 
  echo "Successfully ran Theme Installer"  
  cd site_$projectname/wp-content/themes/$projectname
  echo "Changed Directory to new Theme"

else 
  echo "Could not create & install WP Theme" >&2 
fi

if [ $? -eq 0 ] 
then 
  echo "Downloading Sass/Javascript Tooling"  
  npm install

else 
  echo "Could not install standard plugins" >&2 
fi


echo "Script successfully ran"
exit