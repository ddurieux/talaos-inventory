<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class GLPIInstall {

    var $currentVersion = '2.0';
    var $tablefields = array();

    function run() {
        if (Capsule::schema()->hasTable('glpi_computers')) {
            // Call update
            $this->runUpdate('2.0');
        } else if (Capsule::schema()->hasTable('glpi_assets')) {
            // Get version
            $config = Config::find(1);
            $this->runUpdate($config->version);
        } else {
            // call install
            require_once __DIR__.'/../dbmodels.php';
            $tables = DBModels::getDBModels();
            $this->ConvertPHPTableORM($tables);

            $config = new Config();
            $config->id      = 1;
            $config->version = $this->currentVersion;
            $config->save();
        }
    }



    function ConvertPHPTableORM($tables) {

        foreach ($tables as $tablename => $data) {
            $this->tablefields = $data['fields'];
            Capsule::schema()->create($tablename, function($table) {
                foreach ($this->tablefields as $fieldname=>$data) {
                    switch ($data['type']) {

                        case 'increments':
                            $table->increments($fieldname);
                            break;

                        case 'string':
                            $table->string($fieldname)->nullable();
                            break;

                        case 'text':
                            $table->text($fieldname)->nullable();
                            break;

                        case 'integer':
                            $table->integer($fieldname)->unsigned()->default('0');
                            break;

                        case 'boolean':
                            $table->boolean($fieldname)->default('0');
                            break;

                    }
                }
                $table->timestamps();
            });
        }
    }



    /**
     * We will run update scripts for each version > current version of the DB
     *
     * @param string $versionSource
     */
    function runUpdate($versionSource) {
        $versions = array();
        foreach (glob(__DIR__.'/migrations/*') as $versiondir) {
            $split = explode('/', $versiondir);
            $versions[] = $split[(count($split) - 1)];
        }
        natsort($versions);
        foreach ($versions as $version) {
            if (strnatcmp($versionSource, $version) > 0) {
                require_once __DIR__.'/migrations/'.$version.'/'.$version.'.php';
                $classname = 'glpi_migration_'.str_replace('.', '', $version);
                $item = new $classname();
                $item->run();
            }
        }
    }
}
