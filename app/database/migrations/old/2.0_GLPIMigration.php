<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class GLPIMigration {

    var $classname = '';

    function schema_glpi_assettypes($table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->text('comment')->nullable();
        $table->timestamps();

        $tables = array();
        $tables['name'] = 'glpi_assettypes';
        $tables['fields'] = array(
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


        // Get all in plugins
        $this->findPlugin(__FUNCTION__, $table);
    }


    function schema_glpi_manufacturers($table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->text('comment')->nullable();
        $table->timestamps();

        // Get all in plugins
        $this->findPlugin(__FUNCTION__, $table);
    }


    function schema_glpi_assets($table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->integer('assettypes_id')->unsigned()->default('0');
        $table->integer('entities_id')->default('0');
        $table->boolean('is_recursive')->default('0');
        $table->boolean('is_deleted')->default('0');
        $table->string('serial')->nullable();
        $table->string('inventory_number')->nullable();
        $table->integer('manufacturers_id')->unsigned()->default('0');
        $table->integer('states_id')->unsigned()->default('0');
        $table->text('comment')->nullable();
        $table->timestamps();

        // Get all in plugins
        $this->findPlugin(__FUNCTION__, $table);
    }



    // ============== common functions ============== //
    function findPlugin($funcName, $table) {
        foreach (glob(__DIR__.'/plugins/*.php') as $file) {
            require_once $file;
            $split = explode('/', $file);
            $classname = str_replace('.php', '', $split[(count($split)-1)]);
            if (method_exists($classname, $funcName)) {
                $item = new $classname();
                $item->$funcName($table);
            }
        }
    }


    function run() {
        $class_methods = get_class_methods(new self());

        foreach ($class_methods as $method_name) {
            if (substr($method_name, 0, 7) === "schema_") {
                $tablename = str_replace('schema_', '', $method_name);
                $this->classname = $method_name;
                Capsule::schema()->create($tablename, function($table) {
                    $method_name = $this->classname;
                    $this->$method_name($table);
                });
            }
        }
    }
}
