#!/bin/bash
echo "Database name for new project (with prefix)?"
read databasename
echo "Username?"
read username
echo "Database user password?"
read password
echo "project name? (Ex: KitelyTech Newsroom)"
read humanreadable
echo "text domain (Project name in lowercase without spaces or dashes)"
read projectname
echo "url (Ex: http://localhost/projectname)"
read projecturl

if [ -z "$databasename" ] || [ -z "$username" ] || [ -z "$password" ] || [ -z "$humanreadable" ] || [ -z "$projecturl" ] 
then echo "Missing required information. Aborted"
exit 1
else

  git clone git@github.com:zimaben/FSE_Starter_Theme.git $projectname

fi

if [ $? -eq 0 ] 
then 
  echo "Successfully added Starter Theme"  
#create installer

  cat > installer.php <<EOF
<?php
\$hr = "$humanreadable";
\$pn = "$projectname";
\$pu = "$projecturl";

\$files = array(
	'/admin/admin.php',
	'/admin/classes/figma.php',
	'/admin/classes/slack.php',
	'/admin/integrations.php',
	'/admin/setup.php',
	'/functions.php',
	'/style.css'
);
\$replacements = array(
	'<!HUMANREADABLE->' => \$hr,
	'<!PROJECTURL->' => \$pu,
	'<!PROJECTNAME->'=> \$pn
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
	include('wp-load.php');
	switch_theme(\$pn);
}
runsetup(\$files, \$replacements, \$pn);
EOF
PHP=`which php`
$PHP installer.php
else 
  echo "Could not download Starter Theme" >&2 
fi

if [ $? -eq 0 ] 
then 
  echo "Successfully ran Theme Installer"  
  cd ../
  /usr/local/bin/wp plugin install contact-form-7 --activate
  /usr/local/bin/wp plugin install wp-mail-smtp --activate
  /usr/local/bin/wp plugin install images-to-webp --activate
  /usr/local/bin/wp plugin install w3-total-cache
  cd $projectname
  echo "Caching Plugins are not activated during Development"

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