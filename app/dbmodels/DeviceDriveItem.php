<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceDriveItem';

$table['fields']['interface_type_id'] = DBModels::type('integer');
$table['fields']['is_writer']        = DBModels::type('boolean');
$table['fields']['speed']            = DBModels::type('string');

$table['relationships']['interface_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

