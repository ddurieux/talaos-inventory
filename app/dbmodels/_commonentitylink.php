<?php

$table['fields']['entity_id']    = DBModels::type('integer');

$table['relationships']['entity'] =  array(
        'type'  => 'belongsTo',
        'item'  => 'Entity');

