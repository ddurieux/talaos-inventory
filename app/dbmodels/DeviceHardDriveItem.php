<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceHardDriveItem';

$table['fields']['interface_type_id'] = DBModels::type('integer');
$table['fields']['cache_default']    = DBModels::type('integer');
$table['fields']['cache']            = DBModels::type('string');
$table['fields']['rpm']              = DBModels::type('string');

$table['relationships']['interface_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

