<?php


$table['model'] = 'DeviceNetworkCard';

include "_commondevices.php";

$table['fields']['busID']   = DBModels::type('string');
$table['fields']['mac']     = DBModels::type('string');



