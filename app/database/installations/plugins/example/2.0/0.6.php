<?php

class example_06 {

    function tables(&$tables) {

        // ** glpi_manufacturers ** //
        // Add new field 'country'
        $tables['glpi_manufacturers']['fields']['country'] = array(
                'type'    => 'string',
                'visible' => true
        );
        // make comment hidden in front end
        $tables['glpi_manufacturers']['fields']['comment']['visible'] = false;

        // Add a new table
        // ** glpi_plugin_example_test ** //
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
        $tables['glpi_plugin_example_test'] = $table;

    }
}