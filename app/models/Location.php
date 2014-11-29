<?php

class Location extends CommonNested {


    // 'parent_id' column name
    protected $parentColumn = 'location_id';

    // 'lft' column name
    protected $leftColumn = 'lft';

    // 'rgt' column name
    protected $rightColumn = 'rgt';

    // 'depth' column name
    protected $depthColumn = 'depth';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'location_id', 'lft', 'rgt', 'depth');

}