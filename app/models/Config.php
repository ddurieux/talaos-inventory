<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Config extends Eloquent {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'glpi_configs';
}