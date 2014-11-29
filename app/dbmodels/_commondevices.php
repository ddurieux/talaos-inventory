<?php

$table['fields']        = array();
$table['oldfields']     = array();
$table['renamefields']  = array();
$table['indexes']       = array();
$table['oldindexes']    = array();
$table['relationships'] = array();
$table['menu']          = '';


$devitemmodel = $table['model'].'Item';
$link = strtolower($devitemmodel);
$fk = $link.'_id';


$table['fields'] = array(
    'id'              => DBModels::type('increments',
                                        array('visible' => false)),
    'asset_id'        => DBModels::type('integer'),
    $fk               => DBModels::type('integer'),
    'entity_id'       => DBModels::type('integer'),
    'is_recursive'    => DBModels::type('boolean',
                                        array('visible' => false)),
    'is_deleted'      => DBModels::type('boolean',
                                        array('visible' => false)),
    'is_dynamic'      => DBModels::type('boolean',
                                        array('visible' => false)),
    'serial'          => DBModels::type('string'),
);


$table['relationships'] = array(
    'asset' => array(
        'type' => 'belongsTo',
        'item' => 'Asset'),
    $link => array(
        'type' => 'belongsTo',
        'item' => $devitemmodel),
    'contracts' => array(
        'type'      => 'morphToMany',
        'item'      => 'Contract',
        'table'     => 'linked_contracts'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'linked_documents'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),
    'entity' => array(
        'type'  => 'belongsTo',
        'item'  => 'Entity'),
);