<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceProcessorItem';

$table['fields']['frequency']         = DBModels::type('integer');
$table['fields']['frequency_default'] = DBModels::type('integer');
$table['fields']['nbcores_default']   = DBModels::type('integer');
$table['fields']['nbthreads_default'] = DBModels::type('integer');

