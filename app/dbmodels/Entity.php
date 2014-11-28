<?php

include "_commondropdowns.php";

$table['model'] = 'Entity';

include "_commontreedropdowns.php";

$table['relationships'] = array(
    'asset'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset'),

);