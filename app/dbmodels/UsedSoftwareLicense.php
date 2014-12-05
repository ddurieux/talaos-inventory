<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'UsedSoftwareLicense',
    'menu'          => ''
);

$table['fields'] = array(
    'id'                  => DBModels::type('increments', 
                                            array('visible' => false)),
    'asset_id'            => DBModels::type('integer'),
    'software_license_id' => DBModels::type('integer'),
    'is_deleted'          => DBModels::type('boolean'),
    'is_dynamic'          => DBModels::type('boolean'),
);


