<?php


include "_commonassets_devices.php";

$table['model'] = 'Asset_DeviceControl';

$table['fields']['devicecontrol_id'] = DBModels::type('integer');
$table['fields']['busID']            = DBModels::type('string');

$table['relationships']['devicecontrol'] = array('type' => 'belongsTo',
                                                 'item' => 'DeviceControl');


