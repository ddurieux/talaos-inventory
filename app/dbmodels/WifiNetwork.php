<?php

include "_commondropdowns.php";

$table['model'] = 'Vlan';

$table['fields']['essid']        = DBModels::type('string');
$table['fields']['mode']         = DBModels::type('string'); // comment 'ad-hoc, access_point',


include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";