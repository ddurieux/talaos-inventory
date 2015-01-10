<?php

class Entity extends CommonModel {


    // 'parent_id' column name
    protected $parentColumn = 'entity_id';

    // define tree model
    protected $tree = True;

}