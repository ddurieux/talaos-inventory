<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'AssetVirtualMachine',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                        => DBModels::type('increments', 
                                                  array('visible' => false)),
    'asset_id'                  => DBModels::type('integer', 
                                                  array('visible' => false)),
    'name'                      => DBModels::type('string'),
    'comment'                   => DBModels::type('text'),
    'uuid'                      => DBModels::type('string'),
    'virtual_machine_state_id'  => DBModels::type('integer'),
    'virtual_machine_system_id' => DBModels::type('integer'),
    'virtual_machine_type_id'   => DBModels::type('integer'),
    'vcpu'        => DBModels::type('integer'),
    'is_deleted'       => DBModels::type('boolean'),
    'is_dynamic'       => DBModels::type('boolean'),
    'ram'         => DBModels::type('string'),

);

$table['relationships'] = array(
    'asset'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'virtual_machine_state'  => array(
        'type'  => 'belongsTo',
        'item'  => 'VirtualMachineState'),
    'virtual_machine_system'  => array(
        'type'  => 'belongsTo',
        'item'  => 'VirtualMachineSystem'),
    'virtual_machine_type'  => array(
        'type'  => 'belongsTo',
        'item'  => 'VirtualMachineType'),
);


include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";