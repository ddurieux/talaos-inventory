<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'User',
    'menu'          => 'Administration'
);
$table['fields'] = array(
    'id'                              => DBModels::type('increments',
                                                        array('visible' => false)),
    'name'                            => DBModels::type('string'),
    'comment'                         => DBModels::type('text'),
    'password'                        => DBModels::type('string'),
    'phone'                           => DBModels::type('string'),
    'phone2'                          => DBModels::type('string'),
    'mobile'                          => DBModels::type('string'),
    'realname'                        => DBModels::type('string'),
    'firstname'                       => DBModels::type('string'),
    'location_id'                    => DBModels::type('integer'),
    'language'                        => DBModels::type('string'),
    'use_mode'                        => DBModels::type('integer'),
    'list_limit'                      => DBModels::type('integer'),
    'is_active'                       => DBModels::type('boolean'),
    'auth_id'                        => DBModels::type('integer',
                                                        array('visible' => false)), ///TODO create relation
    'authtype'                        => DBModels::type('integer',
                                                        array('visible' => false)), ///TODO create relation
    'last_login'                      => DBModels::type('datetime'),
    'date_sync'                       => DBModels::type('datetime'),
    'is_deleted'                      => DBModels::type('boolean',
                                                        array('visible' => false)),
    'profile_id'                     => DBModels::type('integer'), ///TODO create relation
    'entitie_id'                     => DBModels::type('integer'), ///TODO create relation
    'usertitle_id'                   => DBModels::type('integer'),
    'usercategory_id'               => DBModels::type('integer'),
    'date_format'                     => DBModels::type('integer',
                                                    array('nullable' => true)),
    'number_format'                   => DBModels::type('integer',
                                                     array('nullable' => true)),
    'names_format'                    => DBModels::type('integer',
                                                      array('nullable' => true)),
    'csv_delimiter'                   => DBModels::type('string'),
    'is_ids_visible'                  => DBModels::type('boolean'),
    'dropdown_chars_limit'            => DBModels::type('integer',
                                                         array('nullable' => true)),
    'use_flat_dropdowntree'           => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'show_jobs_at_login'              => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'priority_1'                      => DBModels::type('string'),
    'priority_2'                      => DBModels::type('string'),
    'priority_3'                      => DBModels::type('string'),
    'priority_4'                      => DBModels::type('string'),
    'priority_5'                      => DBModels::type('string'),
    'priority_6'                      => DBModels::type('string'),
    'followup_private'                => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'task_private'                    => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'default_requesttype_id'         => DBModels::type('integer',
                                                        array('nullable' => true)),
    'password_forget_token'           => DBModels::type('string',
                                                        array('visible' => false)),
    'password_forget_token_date'      => DBModels::type('datetime',
                                                        array('visible' => false)),
    'user_dn'                         => DBModels::type('texte',
                                                        array('visible' => false)),
    'registration_number'             => DBModels::type('string'),
    'show_count_on_tabs'              => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'refresh_ticket_list'            => DBModels::type('integer',
                                                         array('nullable' => true)),
    'set_default_tech'               => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'personal_token'                 => DBModels::type('string',
                                                        array('visible' => false)),
    'personal_token_date'             => DBModels::type('datetime',
                                                        array('visible' => false)),
    'display_count_on_home'           => DBModels::type('integer',
                                                         array('nullable' => true)),
    'notification_to_myself'          => DBModels::type('boolean',
                                                        array('nullable' => true)),
    'duedateok_color'                 => DBModels::type('string'),
    'duedatewarning_color'            => DBModels::type('string'),
    'duedatecritical_color'           => DBModels::type('string'),
    'duedatewarning_less'             => DBModels::type('integer',
                                                        array('nullable' => true)),
    'duedatecritical_less'            => DBModels::type('integer',
                                                         array('nullable' => true)),
    'duedatewarning_unit'             => DBModels::type('string'),
    'duedatecritical_unit'            => DBModels::type('string'),
    'display_options'                 => DBModels::type('text'),
    'is_deleted_ldap'                 => DBModels::type('boolean',
                                                       array('visible' => true)),
    'pdffont'                         => DBModels::type('string'),
    'picture'                         => DBModels::type('string'),
    'begin_date'                      => DBModels::type('datetime'),
    'end_date'                        => DBModels::type('datetime'),
    'keep_devices_when_purging_item'  => DBModels::type('boolean',
                                                   array('nullable' => true)),
    'privatebookmarkorder'            => DBModels::type('longtext'),
    'backcreated'                     => DBModels::type('boolean',
                                                   array('nullable' => true)),
);

$table['relationships'] = array(
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
    'usertitle' => array(
        'type' => 'belongsTo',
        'item' => 'UserTitle'),
    'usercategory' => array(
        'type' => 'belongsTo',
        'item' => 'UserCategory')
);
