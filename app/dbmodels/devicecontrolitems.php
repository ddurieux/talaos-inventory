<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceControlItem';

$table['fields']['interfacetype_id'] = DBModels::type('integer');
$table['fields']['is_raid']          = DBModels::type('boolean');

$table['relationships']['interfacetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

