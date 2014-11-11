<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        if (isset($table['relationships'][$name])) {
            switch ($table['relationships'][$name]['type']) {

                case 'belongsTo' :
                    return($this->belongsTo(
                        $table['relationships'][$name]['item'],
                        $table['relationships'][$name]['field'],
                        'id',
                        $name));
                    break;

            }
        }
        return parent::__call($name, $arguments);
    }


    public function getFields() {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        $fields = array();
        foreach ($table['fields'] as $field=>$data) {
            if ($data['visible']) {
                $fields[$field] = $data['type'];
            }
        }
        return $fields;
    }
}