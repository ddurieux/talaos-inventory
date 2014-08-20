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
            $table->integer('entities_id')->default('0');
            $table->string('name')->nullable();
            $table->string('serial')->nullable();
            $table->string('otherserial')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_num')->nullable();
            $table->integer('users_id_tech')->default('0');
            $table->integer('groups_id_tech')->default('0');
            $table->text('comment');
            $table->date('date_mod')->nullable();
            $table->integer('operatingsystems_id')->default('0');
            $table->integer('operatingsystemversions_id')->default('0');
            $table->integer('operatingsystemservicepacks_id')->default('0');
            $table->string('os_license_number')->nullable();
            $table->string('os_licenseid')->nullable();
            $table->integer('autoupdatesystems_id')->default('0');
            $table->integer('locations_id')->default('0');
            $table->integer('domains_id')->default('0');
            $table->integer('networks_id')->default('0');
            $table->integer('computermodels_id')->default('0');
            $table->integer('computertypes_id')->default('0');
            $table->boolean('is_template')->default('0');
            $table->string('template_name')->nullable();
            $table->integer('manufacturers_id')->default('0');
            $table->boolean('is_deleted')->default('0');
            $table->boolean('is_dynamic')->default('0');
            $table->integer('users_id')->default('0');
            $table->integer('groups_id')->default('0');
            $table->integer('states_id')->default('0');
            $table->decimal('ticket_tco', 20, 4)->default('0.0000');
            $table->string('uuid')->nullable();
        });
    }
}
