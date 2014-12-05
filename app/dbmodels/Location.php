<?php

include "_commondropdowns.php";

$table['model'] = 'Location';

include "_commontreedropdowns.php";


$table['fields']['entity_id']    = DBModels::type('integer');
$table['fields']['is_recursive'] = DBModels::type('boolean',
                                                  array('visible' => false));
$table['fields']['building']  = DBModels::type('string');
$table['fields']['room']      = DBModels::type('string');
$table['fields']['latitude']  = DBModels::type('string');
$table['fields']['longitude'] = DBModels::type('string');
$table['fields']['altitude']  = DBModels::type('string');
$table['fields']['building']  = DBModels::type('string');

$table['relationships']['entity'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Entity');