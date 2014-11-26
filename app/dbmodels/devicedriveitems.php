<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceDriveItem';

$table['fields']['interfacetype_id'] = DBModels::type('integer');
$table['fields']['is_writer']        = DBModels::type('boolean');
$table['fields']['speed']            = DBModels::type('string');

$table['relationships']['interfacetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

