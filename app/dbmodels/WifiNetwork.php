<?php

include "_commondropdowns.php";

$table['model'] = 'Vlan';

$table['fields']['entity_id']    = DBModels::type('integer');
$table['fields']['is_recursive'] = DBModels::type('boolean',
                                                  array('visible' => false));
$table['fields']['essid']        = DBModels::type('string');
$table['fields']['mode']         = DBModels::type('string'); // comment 'ad-hoc, access_point',


$table['relationships']['entity'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Entity');