<?php

include "_commondropdowns.php";

$table['model'] = 'Vlan';

$table['fields']['entity_id']    = DBModels::type('integer');
$table['fields']['is_recursive'] = DBModels::type('boolean',
                                                  array('visible' => false));
$table['fields']['tag']          = DBModels::type('integer');

$table['relationships']['entity'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Entity');