<?php

class CommonGLPI {

    static function getFkForModel($model) {
        return snake_case($model).'_id';
    }
    
    static function relationship($item, $name, $arguments) {
        require __DIR__.'/../dbmodels/'.get_class($item).'.php';

        if (isset($table['relationships'][$name])) {
            switch ($table['relationships'][$name]['type']) {

                case 'belongsTo' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }
                    return $item->belongsTo($table['relationships'][$name]['item'],
                                            $field,
                                            'id',
                                            $name);
                    break;

                case 'belongsToMany' :
                    $field1 = NULL;
                    if (isset($table['relationships'][$name]['field1'])) {
                        $field1 = $table['relationships'][$name]['field1'];
                    }
                    $field2 = NULL;
                    if (isset($table['relationships'][$name]['field2'])) {
                        $field2 = $table['relationships'][$name]['field2'];
                    }
                    $linktable = NULL;
                    if (isset($table['relationships'][$name]['linktable'])) {
                        $linktable = $table['relationships'][$name]['linktable'];
                    }

                    if (isset($table['relationships'][$name]['linkfields']) && is_array($table['relationships'][$name]['linkfields'])) {
                        return $item->belongsToMany($table['relationships'][$name]['item'],
                                                    $linktable,
                                                    $field1,
                                                    $field2)->withPivot($table['relationships'][$name]['linkfields']);
                    
                    } else {
                        return($item->belongsToMany($table['relationships'][$name]['item'],
                                                    $linktable,
                                                    $field1,
                                                    $field2));
                    }
                    break;

                case 'morphTo' :
                    return $item->morphTo($name,
                                          'item_type',
                                          'item_id');
                    break;

                case 'morphMany' :
                    return $item->morphMany($table['relationships'][$name]['item'],
                                            $name, 'item_type', 'item_id');
                    break;

                case 'morphToMany' :
                    return $item->morphToMany($table['relationships'][$name]['item'],
                                              'item',
                                              $table['relationships'][$name]['table']);
                    break;

                case 'hasMany' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }

                    return($item->hasMany($table['relationships'][$name]['item'],
                                          $field,
                                          'id',
                                          $name));
                    break;

                case 'hasOne' :
                    $field = NULL;
                    if (isset($table['relationships'][$name]['field'])) {
                        $field = $table['relationships'][$name]['field'];
                    }

                    return($item->hasMany($table['relationships'][$name]['item'],
                                          $field,
                                          'id'));
                    break;

            }
        }
    }



    static function getFields($item, $restrict) {
        require __DIR__.'/../dbmodels/'.get_class($item).'.php';

        $fields = array(
            'data' => array(),
            'meta' => array()
        );

        foreach ($table['fields'] as $field => $data) {
            if (($restrict == 'visible'
                    &&$data['visible'])
                || $restrict == 'all') {
                $fields['meta'][$field] = array(
                   'type'  => $data['type'],
                   'label' => $field
                );
                switch ($data['type']) {

                    case 'datetime':
                        $fields['data'][$field] = '0000-00-00 00:00:00';
                        break;

                    case 'integer':
                        $fields['data'][$field] = 0;
                        break;

                    case 'boolean':
                        $fields['data'][$field] = 0;
                        break;

                    default:
                        $fields['data'][$field] = '';
                        break;

                }
            }
        }
        foreach ($table['relationships'] as $name=>$data) {
            if (isset($data['field'])) {
                $fields['meta'][$field]['relationship'] = $data['item'];
            } else {
                $foreignKey = snake_case($name).'_id';

                $fields['meta'][$foreignKey]['relationship'] = $data['item'];
            }
        }
        return $fields;
    }



    static function scopeRestrictentity($query, Entity $entity=null) {
        if (is_null($entity)) {
            return $query->with('entity');
        }
        $entityIds = $entity->getDescendantsAndSelf()->lists('id');
        return $query->whereIn('entity_id', $entityIds);
    }
}