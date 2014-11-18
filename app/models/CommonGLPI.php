<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        //require __DIR__.'/../dbmodels/'.preg_replace('/^glpi_/','',$this->table).'.php';
	require $this->getDBmodelFileFromTablename($this->table);

        if (isset($table['relationships'][$name])) {
            switch ($table['relationships'][$name]['type']) {

                case 'belongsTo' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }
                    return($this->belongsTo(
                        $table['relationships'][$name]['item'],
                        $field,
                        'id',
                        $name));
                    break;

                case 'belongsToMany' :
                    $field1 = NULL;
                    if (isset($table['relationships'][$name]['field1'])) {
                        $field1 = $table['relationships'][$name]['field1'];
                    }
                    $field2 = NULL;
                    if (isset($table['relationships'][$name]['field2'])) {
                        $field2 = $table['relationships'][$name]['field2'];
                    }
                    $linktable = NULL;
                    if (isset($table['relationships'][$name]['linktable'])) {
                        $linktable = $table['relationships'][$name]['linktable'];
                    }
                    if (isset($table['relationships'][$name]['condition'])
                           && is_array($table['relationships'][$name]['condition'])
                           && count($table['relationships'][$name]['condition'])==3) {
                               print_r($table['relationships'][$name]['condition']);
                        return($this->belongsToMany(
                            $table['relationships'][$name]['item'],
                            $linktable,
                            $field1,
                            $field2)->Where($table['relationships'][$name]['condition'][0],
                                            $table['relationships'][$name]['condition'][1],
                                            $table['relationships'][$name]['condition'][2]));
                    } else {
                        return($this->belongsToMany(
                            $table['relationships'][$name]['item'],
                            $linktable,
                            $field1,
                            $field2));
                    }
                    break;

                case 'hasMany' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }

                    return($this->hasMany(
                        $table['relationships'][$name]['item'],
                        $field,
                        'id',
                        $name));
                    break;
                
                case 'hasOne' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }
                
                    return($this->hasMany(
                        $table['relationships'][$name]['item'],
                        $field,
                        'id'));
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
                switch ($data['type']) {

                    case 'datetime':
                        $fields['data'][$field] = '0000-00-00 00:00:00';
                        break;

                    case 'integer':
                        $fields['data'][$field] = 0;
                        break;

                    case 'boolean':
                        $fields['data'][$field] = 0;
                        break;

                    default:
                        $fields['data'][$field] = '';
                        break;

                }
            }
        }
        foreach ($table['relationships'] as $name=>$data) {
            if (isset($data['field'])) {
                $fields['meta'][$field]['relationship'] = $data['item'];
            } else {
                $foreignKey = snake_case($name).'_id';

                $fields['meta'][$foreignKey]['relationship'] = $data['item'];
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
