<?php

include "_commondevices.php";

$table['model'] = 'DeviceControl';

$table['fields']['interfacetype_id'] = DBModels::type('integer');
$table['fields']['is_raid']          = DBModels::type('boolean');

$table['relationships']['interfacetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

