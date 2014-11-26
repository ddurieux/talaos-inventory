<?php
include "_commondevices.php";

$table['model'] = 'DeviceCase';

$table['fields']['devicecasetype_id'] = DBModels::type('integer');

$table['relationships']['devicecasetype'] = array(
                                                'type' => 'belongsTo',
                                                'item' => 'DeviceCaseType');
