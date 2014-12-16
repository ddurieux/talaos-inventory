<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceMemoryItem';

$table['fields']['device_memory_type_id'] = DBModels::type('integer');
$table['fields']['size_default']        = DBModels::type('integer');
$table['fields']['frequence']           = DBModels::type('string');

$table['relationships']['device_memory_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'DeviceMemoryType');

