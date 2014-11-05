<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Asset extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'glpi_assets';


    public function __call($name, $arguments) {
        include '../dbmodels/'.$this->table.'.php';

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