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

                        case 'longtext':
                            $table->longText($fieldname)->nullable();
                            break;

                        case 'integer':
                            if (isset($data['nullable']) && $data['nullable']) {
                                $default = NULL;
                                
                                if (isset($data['default'])
                                    && !empty($data['default'])) {
                                    $default = $data['default'];
                                }
                                $table->integer($fieldname)->unsigned()->default($default)->nullable();
                            } else {
                                $default = '0';
                                
                                if (isset($data['default'])
                                    && !empty($data['default'])) {
                                    $default = $data['default'];
                                }
                            
                                $table->integer($fieldname)->unsigned()->default($default);
                            }
                            break;

                        case 'boolean':
                            if (isset($data['nullable']) && $data['nullable']) {
                                $default = NULL;
                                if (isset($data['default'])
                                    && !empty($data['default'])) {
                                    $default = $data['default'];
                                }
                                $table->boolean($fieldname)->default($default)->nullable();;
                            
                            } else {
                                $default = '0';
                                if (isset($data['default'])
                                    && !empty($data['default'])) {
                                    $default = $data['default'];
                                }
                                $table->boolean($fieldname)->default($default);
                            }
                            break;

                        case 'date':
                            $default = '0000-00-00';
                            if (isset($data['default'])
                                && !empty($data['default'])) {
                                $default = $data['default'];
                            }
                            $table->date($fieldname)->default($default);
                            break;

                        case 'datetime':
                            $default = '0000-00-00 00:00:00';
                            if (isset($data['default'])
                                && !empty($data['default'])) {
                                $default = $data['default'];
                            }
                            $table->dateTime($fieldname)->default($default);
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
