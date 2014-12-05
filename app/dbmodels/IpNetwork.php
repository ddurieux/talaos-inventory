<?php

include "_commondropdowns.php";

$table['model'] = 'IpNetwork';

include "_commontreedropdowns.php";

$table['fields']['entity_id']    = DBModels::type('integer');
$table['fields']['is_recursive'] = DBModels::type('boolean',
                                                  array('visible' => false));
$table['fields']['addressable']  = DBModels::type('boolean');
$table['fields']['version']  = DBModels::type('integer'); 
$table['fields']['address']  = DBModels::type('string'); 
$table['fields']['address_0']  = DBModels::type('integer'); 
$table['fields']['address_1']  = DBModels::type('integer'); 
$table['fields']['address_2']  = DBModels::type('integer'); 
$table['fields']['address_3']  = DBModels::type('integer'); 
$table['fields']['netmask']  = DBModels::type('string'); 
$table['fields']['netmask_0']  = DBModels::type('integer'); 
$table['fields']['netmask_1']  = DBModels::type('integer'); 
$table['fields']['netmask_2']  = DBModels::type('integer'); 
$table['fields']['netmask_3']  = DBModels::type('integer'); 
$table['fields']['gateway']  = DBModels::type('string'); 
$table['fields']['gateway_0']  = DBModels::type('integer'); 
$table['fields']['gateway_1']  = DBModels::type('integer'); 
$table['fields']['gateway_2']  = DBModels::type('integer'); 
$table['fields']['gateway_3']  = DBModels::type('integer'); 


$table['relationships']['vlans'] = array(
        'type'      => 'belongsToMany',
        'item'      => 'Vlan',
        'linktable' => 'linked_vlans');
    
$table['relationships']['entity'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Entity');
