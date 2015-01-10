<?php

class ProfileRight extends CommonModel {



    /**
     * Check if have right in this entity
     */
    function haveRight($module, $entity, $right) {
        // check if user avec profile with right in the entity

        //Step 1 : get list of rights available for different profiles AND
        // entities = $entity
        // OR entities = any AND recursive = 1


        //Step 2 : in case recursive = 1, get descendants_cache of these entities and see
        // if we found our entity in it



    }



    /**
     * Get entities array your profiles can have the right for the item
     */
    function entitiesWithRight($module, $right) {

        // get all right with $right and entities + recursive or not
        // return an array with entities


    }
}
