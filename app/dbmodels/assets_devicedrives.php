<?php

include "_commonassets_devices.php";

$table['model'] = 'Asset_DeviceDrive';

$table['fields']['devicedrive_id']   = DBModels::type('integer');
$table['fields']['busID']            = DBModels::type('string');

$table['relationships']['devicedrive'] = array('type' => 'belongsTo',
                                               'item' => 'DeviceDrive');


