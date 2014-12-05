<?php

include "_commondropdowns.php";

$table['model'] = 'IpNetwork';

include "_commontreedropdowns.php";

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
    
$table['relationships']['ip_addresses'] = array(
        'type'      => 'belongsToMany',
        'item'      => 'IpAddress',
        'linktable' => 'linked_ip_networks');
        
include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";