<?php

class DBModels {


    /**
     * Construct big array with schema of DB + some other informations
     *
     * @return type
     */
    static function getDBModels() {
        $tables = array();
        foreach (glob(__DIR__.'/dbmodels/*') as $file) {
            require_once $file;
            $split = explode('/', $file);
            $tableName = str_replace('.php', '', $split[(count($split) - 1)]);
            $tables[$tableName] = $table;
        }
        return $tables;
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
            'type'    => $type
        );
        return array_merge($data, $options);
    }
}
