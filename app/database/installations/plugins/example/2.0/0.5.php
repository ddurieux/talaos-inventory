<?php

class example_05 {

    function tables(&$tables) {

        // ** glpi_manufacturers ** //
        // Add new field 'country'
        $tables['glpi_manufacturers'] = array(
            'country' => array(
                'type'    => 'string',
                'visible' => true
            ),
        );
        // make comment hidden in front end
        $tables['glpi_manufacturers']['comment']['visible'] = false;

    }
}