<?php

include "_commonassets_devices.php";

$table['model'] = 'Asset_DeviceCase';

$table['fields']['devicecase_id'] = DBModels::type('integer');

$table['relationships']['devicecase'] = array('type' => 'belongsTo',
                                              'item' => 'DeviceCase');


