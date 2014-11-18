

= For Dev
==== For install slim + eloquent do in root folder:

composer install

==== For update slim and eloquent:

composer update

==== When add new file in app/models, run in root directory :

composer update

= For all
==== Install GLPI (DB creation tables)

First create a glping DB accessing to user glping with glping password (or update app/config.php)

php glpi install


==== Procedure to update GLPI + plugins
1. extract new glpi archive
2. extract new plugins archives (for update existant plugins)
3. migrate glpi (plugins will be migrated in same time)



#==== Insert data into GLPI tables 
#
#php glpi seed
#
#==== Example of get data + relation data of asset 
#
#http://127.0.0.1/glping/public/Asset/1/manufacturer/assettype




