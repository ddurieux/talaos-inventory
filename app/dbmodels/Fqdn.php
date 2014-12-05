<?php

include "_commondropdowns.php";

$table['model'] = 'Fqdn';

$table['fields']['fqdn']         = DBModels::type('string');


include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";