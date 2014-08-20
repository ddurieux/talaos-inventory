<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Example migration for use with "glpi"
 */
class ComputerMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('computers');
        Capsule::schema()->create('computers', function($table) {
            $table->increments('id');
            $table->string('name');
        });
    }
}
