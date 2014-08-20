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
            $table->integer('entities_id');
            $table->string('name');
            $table->string('serial');
            $table->string('otherserial');
            $table->string('contact');
            $table->string('contact_num');
            $table->integer('users_id_tech');
            $table->integer('groups_id_tech');
            $table->text('comment');
            $table->date('date_mod');
            $table->integer('operatingsystems_id');
            $table->integer('operatingsystemversions_id');
            $table->integer('operatingsystemservicepacks_id');
            $table->string('os_license_number');
            $table->string('os_licenseid');
            $table->integer('autoupdatesystems_id');
            $table->integer('locations_id');
            $table->integer('domains_id');
            $table->integer('networks_id');
            $table->integer('computermodels_id');
            $table->integer('computertypes_id');
            $table->boolean('is_template');
            $table->string('template_name');
            $table->integer('manufacturers_id');
            $table->boolean('is_deleted');
            $table->boolean('is_dynamic');
            $table->integer('users_id');
            $table->integer('groups_id');
            $table->integer('states_id');
            $table->decimal('ticket_tco', 20, 4);
            $table->string('uuid');
        });
    }
}
