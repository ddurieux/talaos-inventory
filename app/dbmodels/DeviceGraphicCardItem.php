<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceGraphicCardItem';

$table['fields']['interfacetype_id'] = DBModels::type('integer');
$table['fields']['memory_default']   = DBModels::type('integer');
$table['fields']['chipset']          = DBModels::type('string');

$table['relationships']['interfacetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'InterfaceType');


