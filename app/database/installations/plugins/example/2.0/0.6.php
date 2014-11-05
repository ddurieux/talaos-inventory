<?php

class example_06 {

    function tables(&$tables) {

        // ** glpi_manufacturers ** //
        // Add new field 'country'
        $tables['glpi_manufacturers']['fields']['country'] = GLPIInstallation::type('string');
        // make comment hidden in front end
        $tables['glpi_manufacturers']['fields']['comment']['visible'] = false;

        // Add a new table
        // ** glpi_plugin_example_test ** //
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
        $tables['glpi_plugin_example_test'] = $table;

    }
}