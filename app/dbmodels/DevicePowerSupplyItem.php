<?php

include "_commondeviceitems.php";

$table['model'] = 'DevicePowerSupplyItem';

$table['fields']['power']  = DBModels::type('string');
$table['fields']['is_atx'] = DBModels::type('boolean');


