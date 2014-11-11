<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        if (isset($table['relationships'][$name])) {
            switch ($table['relationships'][$name]['type']) {

                case 'belongsTo' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }
                    return($this->belongsTo(
                        $table['relationships'][$name]['item'],
                        NULL,
                        'id',
                        $name));
                    break;

            }
        }
        return parent::__call($name, $arguments);
    }


    public function getFields() {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        return $table['visible'];
    }
}