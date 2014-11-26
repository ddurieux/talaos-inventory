<?php

include "_commondevices.php";

$table['model'] = 'DeviceHardDrive';

$table['fields']['interfacetype_id'] = DBModels::type('integer');
$table['fields']['cache_default']    = DBModels::type('integer');
$table['fields']['cache']            = DBModels::type('string');
$table['fields']['rpm']              = DBModels::type('string');

$table['relationships']['interfacetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

