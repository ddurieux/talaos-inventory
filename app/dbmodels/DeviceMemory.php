<?php

$table['model'] = 'DeviceMemory';

include "_commondevices.php";

$table['fields']['busID']            = DBModels::type('string');
$table['fields']['size']             = DBModels::type('integer');


