<?php

class glpi20 {

    function tables() {
        $tables = array();

        // ** glpi_assettypes ** //
        $table = array();
        $table['fields'] = array(
            'id' => array(
                'type' => 'increments'
            ),
            'name' => array(
                'type'    => 'string',
                'visible' => true
            ),
            'comment' => array(
                'type'    => 'text',
                'visible' => true
            )
        );
        $tables['glpi_assettypes'] = $table;

        // ** glpi_manufacturers ** //
        $table = array();
        $table['fields'] = array(
            'id' => array(
                'type' => 'increments'
            ),
            'name' => array(
                'type'    => 'string',
                'visible' => true
            ),
            'comment' => array(
                'type'    => 'text',
                'visible' => true
            )
        );
        $tables['glpi_manufacturers'] = $table;

        // ** glpi_assets ** //
        $table = array();
        $table['fields'] = array(
            'id' => array(
                'type' => 'increments'
            ),
            'name' => array(
                'type'    => 'string',
                'visible' => true
            ),
            'assettypes_id' => array(
                'type'    => 'integer',
                'visible' => true
            ),
            'entities_id' => array(
                'type'    => 'integer',
                'visible' => true
            ),
            'is_recursive' => array(
                'type'    => 'is_deleted',
                'visible' => false
            ),
            'serial' => array(
                'type'    => 'string',
                'visible' => true
            ),
            'inventory_number' => array(
                'type'    => 'string',
                'visible' => true
            ),
            'manufacturers_id' => array(
                'type'    => 'integer',
                'visible' => true
            ),
            'states_id' => array(
                'type'    => 'integer',
                'visible' => true
            ),
            'comment' => array(
                'type'    => 'text',
                'visible' => true
            )
        );
        $tables['glpi_assets'] = $table;
        return $tables;
    }
}