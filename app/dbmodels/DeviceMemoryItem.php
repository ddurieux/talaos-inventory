<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceMemoryItem';

$table['fields']['devicememorytype_id'] = DBModels::type('integer');
$table['fields']['size_default']        = DBModels::type('integer');
$table['fields']['frequence']           = DBModels::type('string');

$table['relationships']['devicememorytype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'DeviceMemoryType');

