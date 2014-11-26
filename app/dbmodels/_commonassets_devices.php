<?php

$table['fields']        = array();
$table['oldfields']     = array();
$table['renamefields']  = array();
$table['indexes']       = array();
$table['oldindexes']    = array();
$table['relationships'] = array();
$table['menu']          = '';


$devmodel = str_replace('Asset_','',$table['model']);
$link = strtolower($devmodel);
$fk = $link.'_id';


$table['fields'] = array(
    'id'              => DBModels::type('increments', 
                                        array('visible' => false)),
    'asset_id'        => DBModels::type('integer'),
    $fk               => DBModels::type('integer'),
    'entity_id'       => DBModels::type('integer'), ///TODO create relation
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
        'item' => $devmodel),
       
    'contracts' => array(
        'type'      => 'morphToMany',
        'item'      => 'Contract',
        'table'     => 'glpi_contracts_items'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'glpi_documents_items'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),    
);