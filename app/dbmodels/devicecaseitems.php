<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceCaseItem';

$table['fields']['devicecasetype_id'] = DBModels::type('integer');

$table['relationships']['devicecasetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'DeviceCaseType');
