<?php

include "_commondeviceitems.php";

$table['model'] = 'DeviceNetworkCardItem';

$table['fields']['mac_default']         = DBModels::type('string');
$table['fields']['bandwidth']           = DBModels::type('string');

