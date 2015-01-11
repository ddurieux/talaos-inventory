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



        // if not autorized
        /*
        header('HTTP/1.1 401 Unauthorized', true, 401);
        die('HTTP/1.1 401 Unauthorized');
         */
    }



    /**
     * Get entities array your profiles can have the right for the item
     */
    static function entitiesWithRight($module, $right) {
        $a = ProfileRight::where('name', '=', $module)->with(array('profile_user' => function($query) {
            $query->where('user_id', '=', 1);
            $query->with(array('entity' => function($query) { $query->select('id', 'descendants_cache');}));
         }))->get()->toArray();

        $entities = array();
        foreach ($a as $data) {
            if (intval($data['rights']) & $right) {
                foreach ($data['profile_user'] as $datae) {
                    if ($datae['is_recursive'] == 0) {
                        $entities[] = $datae['entity_id'];
                    } else {
                        $entities = array_merge($entities, json_decode($datae['entity']['descendants_cache']));
                    }
                }
            }
        }
        return array_unique($entities);
    }
}
