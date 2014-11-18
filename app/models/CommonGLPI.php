<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        //require __DIR__.'/../dbmodels/'.preg_replace('/^glpi_/','',$this->table).'.php';
	require $this->getDBmodelFileFromTablename($this->table);

        if (isset($table['relationships'][$name])) {
            $field = NULL;
            if (isset($table['relationships'][$name]['field'])) {
                $field = $table['relationships'][$name]['field'];
            }
            switch ($table['relationships'][$name]['type']) {

                case 'belongsTo' :
                    return($this->belongsTo(
                        $table['relationships'][$name]['item'],
                        $field,
                        'id',
                        $name));
                    break;

                case 'hasMany' :
                    return($this->hasMany(
                        $table['relationships'][$name]['item'],
                        $field,
                        'id',
                        $name));
                    break;

            }
        }
        return parent::__call($name, $arguments);
    }


    public function getFields($restrict='visible') {
        //require __DIR__.'/../dbmodels/'.preg_replace('/^glpi_/','',$this->table).'.php';
	require $this->getDBmodelFileFromTablename($this->table);

        $fields = array(
            'data' => array(),
            'meta' => array()
        );

        foreach ($table['fields'] as $field => $data) {
            if (($restrict == 'visible'
                    &&$data['visible'])
                || $restrict == 'all') {
                $fields['meta'][$field] = array(
                   'type'  => $data['type'],
                   'label' => $field
                );
                $fields['data'][$field] = 0; // TODO get the right default value
            }
        }
        return $fields;
    }

    function getDBmodelFileFromTablename($tablename) {
        return __DIR__.'/../dbmodels/'.preg_replace('/^glpi_/','',$tablename).'.php';
    }

    static function getRelatedModels($id) {
        return array();
    }
}
