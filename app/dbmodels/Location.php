<?php

include "_commondropdowns.php";

$table['model'] = 'Location';

include "_commontreedropdowns.php";



$table['fields']['building']  = DBModels::type('string');
$table['fields']['room']      = DBModels::type('string');
$table['fields']['latitude']  = DBModels::type('string');
$table['fields']['longitude'] = DBModels::type('string');
$table['fields']['altitude']  = DBModels::type('string');
$table['fields']['building']  = DBModels::type('string');

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";