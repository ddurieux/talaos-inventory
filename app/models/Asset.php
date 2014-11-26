<?php

class Asset extends CommonGLPI {

    /**
     * type is used to define the 'category' of the related model
     * new is bool, true if exist 1 or more data in model table for this id
     */
    static function getRelatedModels($id) {
        return array(
            'AssetPower' => array(
                'type' => 'capacity',
                'new'  => True
            ),
            'AssetDisplay' => array(
                'type' => 'capacity',
                'new'  => True
            ),
            'AssetDisk' => array(
                'type' => 'capacity',
                'new'  => True
            ),
            'AssetPrinter' => array(
                'type' => 'capacity',
                'new'  => True
            ),
            

        );
    }

}