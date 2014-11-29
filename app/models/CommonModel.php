<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonModel extends Eloquent {

    public function __call($name, $arguments) {
        $ret = CommonGLPI::relationship($this, $name, $arguments);
        if (!empty($ret)) {
            return $ret;
        }
        return parent::__call($name, $arguments);
    }


    public function getFields($restrict='visible') {
        return CommonGLPI::getFields($this, $restrict);
    }



    static function getRelatedModels($id) {
        return array();
    }



    public function scopeRestrictentity($query, Entity $entity=null) {
        return CommonGLPI::scopeRestrictentity($query, $entity);
    }
}