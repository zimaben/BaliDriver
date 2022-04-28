#!/bin/bash
echo "Class name for new Plugin?"
read classname
echo "Text domain (plugin namespace)"
read classprefix


if [ -z "$classname" ] || [ -z "$classprefix" ] 
then echo "Missing required information. Aborted"

#create base file
cat > $classprefix.php <<EOF

EOF

#create installer

  cat > installer.php <<EOF
<?php
\$pn = "$<!PLUGINNAME->";
\$pp = "$<!PLUGINPATH->";

\$files = array(
	'/libary/admin/add-fields.php',
    '/libary/admin/ajax.php',
    '/libary/api/endpoints.php',
	'/libary/api/methods.php',
    '/libary/blocks/blocks.php',
	'/libary/core/build.php',
    '/libary/core/pages.php',
    '/libary/core/post-types.php',
    '/libary/core/setup.php',
    '/libary/core/taxonomies.php',
	'/libary/template/view.php',
	'/style.css'
);
\$replacements = array(
	'<!PLUGINNAME->' => \$pn,
	'<!PLUGINPATH->' => \$pp,
);
function runsetup(\$files, \$replacements){
	foreach(\$files as \$file){
		\$path = __DIR__ .  \$file;
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
}
runsetup(\$files, \$replacements);
EOF
PHP=`which php`
$PHP installer.php
else 
  echo "Could not set up Plugin" >&2 
fi

if [ $? -eq 0 ] 
then 
  echo "Successfully ran Plugin Installer"  
  rm installer.php
else 
  echo "Could not create Plugin" >&2 
  rm installper.php
fi

if [ $? -eq 0 ] 
then 
  echo "Downloading Sass/Javascript Tooling"  
  npm install

else 
  echo "Please look over files and fix" >&2 
fi


echo "Script successfully ran"
exit