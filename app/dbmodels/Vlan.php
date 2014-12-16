<?php

include "_commondropdowns.php";

$table['model'] = 'Vlan';

$table['fields']['tag']          = DBModels::type('integer');

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";