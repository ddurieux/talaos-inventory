<?php

class DBModels {


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
        return array_merge($data, $options);
    }
}
