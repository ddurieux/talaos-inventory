<?php

class Location extends CommonModel {

    // 'parent_id' column name
    protected $parentColumn = 'location_id';

    // define tree model
    protected $tree = True;

}