<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

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


    public function getFields() {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        $fields = array(
            'data' => array(),
            'meta' => array()
        );

        foreach ($table['fields'] as $field => $data) {
            if ($data['visible']) {
                $fields['meta'][$field] = array(
                   'type'  => $data['type'],
                   'label' => $field
                );
                $fields['data'][$field] = 0; // TODO get the right default value
            }
        }
        return $fields;
    }



    static function getRelatedModels($id) {
        return array();
    }
}