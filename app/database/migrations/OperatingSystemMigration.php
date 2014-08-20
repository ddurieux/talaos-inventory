<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Example migration for use with "glpi"
 */
class OperatingSystemMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('glpi_operatingsystems');
        Capsule::schema()->create('glpi_operatingsystems', function($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('comment');
        });
    }
}
