<?php

include "_commonassets_devices.php";

$table['model'] = 'Asset_DeviceHardDrive';

$table['fields']['deviceharddrive_id']   = DBModels::type('integer');
$table['fields']['busID']                = DBModels::type('string');

$table['relationships']['deviceharddrive'] = array('type' => 'belongsTo',
                                                   'item' => 'DeviceHardDrive');



