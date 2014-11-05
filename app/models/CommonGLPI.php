<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonGLPI extends Eloquent {

    protected $table = '';

    public function __call($name, $arguments) {
        require __DIR__.'/../dbmodels/'.$this->table.'.php';

        if (isset($table['relationships'][$name])) {
            switch ($table['relationships'][$name][0]) {

                case 'belongsTo' :
                    return($this->belongsTo(
                        $table['relationships'][$name][1],
                        $table['relationships'][$name][2],
                        'id',
                        $name));
                    break;

            }
        }
        return parent::__call($name, $arguments);
    }

}