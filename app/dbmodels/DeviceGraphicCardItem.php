<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceGraphicCardItem';

$table['fields']['interface_type_id'] = DBModels::type('integer');
$table['fields']['memory_default']   = DBModels::type('integer');
$table['fields']['chipset']          = DBModels::type('string');

$table['relationships']['interface_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');


