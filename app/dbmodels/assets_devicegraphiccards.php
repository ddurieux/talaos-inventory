<?php

include "_commonassets_devices.php";

$table['model'] = 'Asset_DeviceGraphicCard';

$table['fields']['devicegraphicard_id'] = DBModels::type('integer');
$table['fields']['busID']               = DBModels::type('string');
$table['fields']['memory']              = DBModels::type('integer');

$table['relationships']['devicegraphiccard'] = array('type' => 'belongsTo',
                                                     'item' => 'DeviceGraphicCard');




