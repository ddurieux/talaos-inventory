<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class GLPIInstallation {

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

            $tables = $this->getTables($this->currentVersion);
            $this->ConvertPHPTableORM($tables);

            $config = new Config();
            $config->id      = 1;
            $config->version = $this->currentVersion;
            $config->save();
        }
    }



    function getTables($version) {
        require_once __DIR__.'/installations/'.$version.'/'.$version.'.php';
        $classname = 'glpi'.str_replace('.', '', $version);
        $item = new $classname();
        $tables = $item->tables();

        // Load plugins
        foreach (glob(__DIR__.'/installations/plugins/*') as $plugindir) {
            $split = explode('/', $plugindir);
            $pluginName = $split[(count($split) - 1)];
            $versions = array();
            foreach (glob($plugindir.'/2.0/*.php') as $file) {
                $file = str_replace('.php', '', $file);
                $split = explode('/', $file);
                $versions[] = $split[(count($split) - 1)];
            }
            natsort($versions);

            // use only last version
            $pluginVersion = $versions[(count($versions) - 1)];
            require_once $plugindir.'/2.0/'.$pluginVersion.'.php';

            $classname = $pluginName.'_'.str_replace('.', '', $pluginVersion);
            $item = new $classname();

            $item->tables($tables);
        }
        return $tables;
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



    /**
     * Function used to define info of field of DB
     *
     * @param string $type
     * @param boolean $visibility
     * @param array $options
     *
     * @return array
     */
    static function type($type, $visibility=true, $options=array()) {
        $data = array(
            'type'    => $type,
            'visible' => $visibility
        );
        $data = array_merge($data, $options);
        return $data;
    }
}
