<?php

$link = strtolower($table['model']);
$childlink = str_plural($link).'child';
$fk = $link.'_id';


$table['fields'][$fk] = DBModels::type('integer');
$table['fields']['completename']      = DBModels::type('text',
                                                       array('visible' => false));
$table['fields']['level']             = DBModels::type('integer',
                                                       array('visible' => false));
$table['fields']['ancestors_cache']   = DBModels::type('longtext',
                                                       array('visible' => false));
$table['fields']['descendants_cache'] = DBModels::type('longtext',
                                                       array('visible' => false));


$table['relationships'][$link] =  array(
        'type'  => 'belongsTo',
        'item'  => $table['model']);
$table['relationships'][$childlink] =  array(
        'type'  => 'hasMany',
        'item'  => $table['model'],
        'field' => $fk);

