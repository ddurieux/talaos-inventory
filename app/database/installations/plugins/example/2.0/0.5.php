<?php

class example_05 {

    function tables(&$tables) {

        // ** glpi_manufacturers ** //
        // Add new field 'country'
        $tables['glpi_manufacturers']['fields']['country'] = GLPIInstallation::type('string');
        // make comment hidden in front end
        $tables['glpi_manufacturers']['fields']['comment']['visible'] = false;

    }
}