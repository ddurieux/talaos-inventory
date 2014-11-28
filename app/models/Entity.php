<?php

class Entity extends NestedGLPI {


    // 'parent_id' column name
    protected $parentColumn = 'entity_id';

    // 'lft' column name
    protected $leftColumn = 'lft';

    // 'rgt' column name
    protected $rightColumn = 'rgt';

    // 'depth' column name
    protected $depthColumn = 'depth';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'entity_id', 'lft', 'rgt', 'depth');

}