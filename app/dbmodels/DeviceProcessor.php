<?php


$table['model'] = 'DeviceProcessor';

include "_commondevices.php";

$table['fields']['busID']     = DBModels::type('string');
$table['fields']['frequency'] = DBModels::type('integer');
$table['fields']['nbcores']   = DBModels::type('integer');
$table['fields']['nbthreads'] = DBModels::type('integer');


