<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Infocom',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                  => DBModels::type('increments', 
                                            array('visible' => false)),
    'itemtype'            => DBModels::type('string', 
                                            array('visible' => false,
                                                  'size'    => 100)),
    'item_id'            => DBModels::type('integer', 
                                            array('visible' => false)),
    'entity_id'         => DBModels::type('integer'),
    'is_recursive'        => DBModels::type('boolean', 
                                            array('visible' => false)),
    'comment'             => DBModels::type('text'),
    'buy_date'            => DBModels::type('date'),
    'use_date'            => DBModels::type('date'),
    'order_date'          => DBModels::type('date'),
    'delivery_date'       => DBModels::type('date'),
    'inventory_date'      => DBModels::type('date'),
    'warranty_date'       => DBModels::type('date'),
    'warranty_duration'   => DBModels::type('integer'),
    'warranty_info'       => DBModels::type('string'),
    'supplier_id'        => DBModels::type('integer'), 
    'order_number'        => DBModels::type('string'),
    'delivery_number'     => DBModels::type('string'),
    'immo_number'         => DBModels::type('string'),
    'value'               => DBModels::type('decimal'),
    'warranty_value'      => DBModels::type('decimal'),
    'sink_time'           => DBModels::type('integer'),
    'sink_type'           => DBModels::type('integer'),
    'sink_coeff'          => DBModels::type('float'),
    'bill'                => DBModels::type('string'),
    'budget_id'          => DBModels::type('integer'),
    'alert'               => DBModels::type('integer'),
    
                                         
);
  
$table['relationships'] = array(
    'budget' => array(
        'type' => 'belongsTo',
        'item' => 'Budget'),
    'supplier' => array(
        'type' => 'belongsTo',
        'item' => 'Supplier'),        
);
