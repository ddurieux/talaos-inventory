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
            $split = explode('/', $file);
            $tableName = str_replace('.php', '', $split[(count($split) - 1)]);
            if ($tableName[0] != '_') {
                require_once $file;
                $tableName = str_replace('\\', '', snake_case(str_plural($table['model'])));
                $tables[$tableName] = $table;
            }
        }
        return $tables;
    }


    /**
     * Function used to define info of field of DB
     *
     * @param string $type
     * @param array $options
     *
     * @return array
     */
    static function type($type, $options=array()) {
        $data = array(
            'type'    => $type
        );
        $data = array_merge($data, $options);
        
        if (!isset($data['visible'])) {
            $data['visible'] = true;
        }
        return $data;
    }
}
