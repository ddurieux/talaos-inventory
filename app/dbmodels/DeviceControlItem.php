<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceControlItem';

$table['fields']['interface_type_id'] = DBModels::type('integer');
$table['fields']['is_raid']          = DBModels::type('boolean');

$table['relationships']['interface_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');

