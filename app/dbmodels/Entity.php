<?php

include "_commondropdowns.php";

$table['model'] = 'Entity';

include "_commontreedropdowns.php";

$table['fields']['address']                             = DBModels::type('text');
$table['fields']['postcode']                            = DBModels::type('string');
$table['fields']['town']                                = DBModels::type('string');
$table['fields']['state']                               = DBModels::type('string');
$table['fields']['country']                             = DBModels::type('string');
$table['fields']['website']                             = DBModels::type('string');
$table['fields']['phonenumber']                         = DBModels::type('string');
$table['fields']['fax']                                 = DBModels::type('string');
$table['fields']['email']                               = DBModels::type('string');
$table['fields']['admin_email']                         = DBModels::type('string');
$table['fields']['admin_email_name']                    = DBModels::type('string');
$table['fields']['admin_reply']                         = DBModels::type('string');
$table['fields']['admin_reply_name']                    = DBModels::type('string');
$table['fields']['notification_subject_tag']            = DBModels::type('string');
$table['fields']['ldap_dn']                             = DBModels::type('string');
$table['fields']['tag']                                 = DBModels::type('string');
$table['fields']['authldap_id']                         = DBModels::type('integer'); ///TODO create relation
$table['fields']['mail_domain']                         = DBModels::type('string');
$table['fields']['entity_ldapfilter']                   = DBModels::type('text');
$table['fields']['mailing_signature']                   = DBModels::type('text');
$table['fields']['cartridges_alert_repeat']             = DBModels::type('integer');
$table['fields']['consumables_alert_repeat']            = DBModels::type('integer');
$table['fields']['use_licenses_alert']                  = DBModels::type('integer');
$table['fields']['send_licenses_alert_before_delay']    = DBModels::type('integer');
$table['fields']['use_contracts_alert']                 = DBModels::type('integer');
$table['fields']['send_contracts_alert_before_delay']   = DBModels::type('integer');
$table['fields']['use_infocoms_alert']                  = DBModels::type('integer');
$table['fields']['send_infocoms_alert_before_delay']    = DBModels::type('integer');
$table['fields']['use_reservations_alert']              = DBModels::type('integer');
$table['fields']['autoclose_delay']                     = DBModels::type('integer');
$table['fields']['notclosed_delay']                     = DBModels::type('integer');
$table['fields']['calendar_id']                         = DBModels::type('integer'); ///TODO create relation
$table['fields']['auto_assign_mode']                    = DBModels::type('integer');
$table['fields']['tickettype']                          = DBModels::type('integer');
$table['fields']['max_closedate']                       = DBModels::type('datetime');
$table['fields']['inquest_config']                      = DBModels::type('integer');
$table['fields']['inquest_rate']                        = DBModels::type('integer');
$table['fields']['inquest_delay']                       = DBModels::type('integer');
$table['fields']['inquest_URL']                         = DBModels::type('string');
$table['fields']['autofill_warranty_date']              = DBModels::type('string');
$table['fields']['autofill_use_date']                   = DBModels::type('string');
$table['fields']['autofill_buy_date']                   = DBModels::type('string');
$table['fields']['autofill_delivery_date']              = DBModels::type('string');
$table['fields']['autofill_order_date']                 = DBModels::type('string');
$table['fields']['tickettemplate_id']                   = DBModels::type('integer'); ///TODO create relation
$table['fields']['entities_id_software']                = DBModels::type('integer');
$table['fields']['default_contract_alert']              = DBModels::type('integer');
$table['fields']['default_infocom_alert']               = DBModels::type('integer');
$table['fields']['default_cartridges_alarm_threshold']  = DBModels::type('integer');
$table['fields']['default_consumables_alarm_threshold'] = DBModels::type('integer');
$table['fields']['delay_send_emails']                   = DBModels::type('integer');


$table['relationships'] = array(
    'asset'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset'),

);