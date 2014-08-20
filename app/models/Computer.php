<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Computer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'glpi_computers';


   public function operatingsystems()
   {
      return $this->belongsTo('OperatingSystem');
   }

}
