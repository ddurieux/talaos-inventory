<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'InstalledSoftwareVersion',
    'menu'          => ''
);

$table['fields'] = array(
    'id'                  => DBModels::type('increments', 
                                            array('visible' => false)),
    'asset_id'            => DBModels::type('integer'),
    'software_version_id' => DBModels::type('integer'),
    'is_deleted'          => DBModels::type('boolean'),
    'is_dynamic'          => DBModels::type('boolean'),
    'is_deleted_asset'    => DBModels::type('boolean'),
    'is_template_asset'   => DBModels::type('boolean'),
);


include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";