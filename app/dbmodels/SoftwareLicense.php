<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'SoftwareLicense',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                        => DBModels::type('increments',
                                                  array('visible' => false)),
    'name'                      => DBModels::type('string'),
    'comment'                   => DBModels::type('text'),
    'software_id'               => DBModels::type('integer'),
    'software_license_type_id'  => DBModels::type('integer'),
    'number'                    => DBModels::type('integer'),
    'serial'                    => DBModels::type('string'),
    'inventory_number'          => DBModels::type('string'),
    'software_version_buy_id'   => DBModels::type('integer'),
    'software_version_use_id'   => DBModels::type('integer'),
    'is_valid'                  => DBModels::type('boolean',
                                                  array('visible' => false)),
    'expire'                    => DBModels::type('date'),
);

$table['relationships'] = array(
    'assets'     => array(
        'type'  => 'belongsToMany',
        'item'  => 'Asset',
        'linktable' => 'used_software_licenses',
        'linkfields' => array('is_deleted', 'is_dynamic')),
    'software' => array(
        'type' => 'belongsTo',
        'item' => 'Software'),
    'software_version_buy' => array(
        'type' => 'belongsTo',
        'item' => 'SoftwareVersion'),
    'software_version_use' => array(
        'type' => 'belongsTo',
        'item' => 'SoftwareVersion'),
    'software_license_type' => array(
        'type' => 'belongsTo',
        'item' => 'SoftwareLicenseType'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";
