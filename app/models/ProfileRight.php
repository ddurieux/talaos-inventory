<?php

class ProfileRight extends CommonModel {



    /**
     * Check if have right in this entity
     */
    static function haveRight($module, $right, $entity=null) {
        $entities = $this->entitiesWithRight($module, $right);
        if (is_null($entity)
                && !empty($entities)) {
            return true;
        } else if (!is_null($entity)
                && in_array($entity, $entities)) {
            return true;
        }
        // Else
        header('HTTP/1.1 401 Unauthorized', true, 401);
        die();
    }



    /**
     * Get entities array your profiles can have the right for the item
     */
    static function entitiesWithRight($module, $right) {

        $a = ProfileUser::where('user_id', '=', 1)->with(array('profile_right' => function($query) use($module) {
            $query->where('name', '=', $module);
         }))->with(array('entity' => function($query) { $query->select('id', 'descendants_cache');}))->get()->toArray();

        $entities = array();
        foreach ($a as $data) {
            foreach ($data['profile_right'] as $datar) {
                if (intval($datar['rights']) & $right) {
                    if ($data['is_recursive'] == 0) {
                        $entities[] = $data['entity_id'];
                    } else {
                        $entities = array_merge($entities, json_decode($data['entity']['descendants_cache']));
                    }
                }
            }
        }
        $entities_unique = array_unique($entities);

        if (count($entities_unique) > 0) {
            return $entities_unique;
        }
        header('HTTP/1.1 401 Unauthorized', true, 401);
        die();
    }
}
