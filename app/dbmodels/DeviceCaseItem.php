<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceCaseItem';

$table['fields']['device_case_type_id'] = DBModels::type('integer');

$table['relationships']['device_case_type'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'DeviceCaseType');
