<?php

class glpi20 {

    function tables() {
        $tables = array();

        // ** glpi_assettypes ** //
        $table = array(
            'fields'         => array(),
            'index'         => array(),
            'relationships' => array()
        );
        $table['fields'] = array(
            'id'      => GLPIInstallation::type('increments'),
            'name'    => GLPIInstallation::type('string'),
            'comment' => GLPIInstallation::type('text'),
        );
        $tables['glpi_assettypes'] = $table;

        // ** glpi_manufacturers ** //
        $table = array(
            'fields'         => array(),
            'index'         => array(),
            'relationships' => array()
        );
        $table['fields'] = array(
            'id'      => GLPIInstallation::type('increments'),
            'name'    => GLPIInstallation::type('string'),
            'comment' => GLPIInstallation::type('text'),
        );
        $tables['glpi_manufacturers'] = $table;

        // ** glpi_assets ** //
        $table = array(
            'fields'         => array(),
            'index'         => array(),
            'relationships' => array()
        );
        $table['fields'] = array(
            'id'               => GLPIInstallation::type('increments'),
            'name'             => GLPIInstallation::type('string'),
            'assettypes_id'    => GLPIInstallation::type('integer'),
            'entities_id'      => GLPIInstallation::type('integer'),
            'is_recursive'     => GLPIInstallation::type('boolean', false),
            'is_deleted'       => GLPIInstallation::type('boolean', false),
            'serial'           => GLPIInstallation::type('string'),
            'inventory_number' => GLPIInstallation::type('string'),
            'manufacturers_id' => GLPIInstallation::type('integer'),
            'states_id'        => GLPIInstallation::type('integer'),
            'comment'          => GLPIInstallation::type('text'),
        );
        $tables['glpi_assets'] = $table;

        // ** glpi_configs ** //
        $table = array(
            'fields'         => array(),
            'index'         => array(),
            'relationships' => array()
        );
        $table['fields'] = array(
            'id'      => GLPIInstallation::type('increments'),
            'version' => GLPIInstallation::type('string')
        );
        $tables['glpi_configs'] = $table;


        return $tables;
    }
}