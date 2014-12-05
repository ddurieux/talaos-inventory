<?php

include "_commondropdowns.php";

$table['model'] = 'Domain';

$table['fields']['entity_id']    = DBModels::type('integer');
$table['fields']['is_recursive'] = DBModels::type('boolean',
                                                  array('visible' => false));
