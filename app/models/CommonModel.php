<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommonModel extends Eloquent {

    // Default rights
    public $READ   = 1;
    public $UPDATE = 2;
    public $CREATE = 4;
    public $DELETE = 8;
    public $PURGE  = 16;

    // Used for put in cache data for regenerate tree
    protected $treeAll = array();
    protected $treeAllA = array();
    protected $treeAllD = array();

    static function getFkForModel($model) {
        return snake_case($model).'_id';
    }

    public function __call($name, $arguments) {
        $ret = $this->relationship($this, $name, $arguments);
        if (!empty($ret)) {
            return $ret;
        }
        return parent::__call($name, $arguments);
    }


    public function getFields($restrict='visible') {
        require __DIR__.'/../dbmodels/'.get_class($this).'.php';

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



    static function getRelatedModels($id) {
        return array();
    }



    public function scopeRestrictentity($query, $entities=array()) {
        if (empty($entities)) {
            return $query;
        }
        return $query->whereIn('entity_id', $entities);
    }


    function relationship($item, $name, $arguments) {
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



    /**
     * Manage events.
     * List of events: http://laravel.com/docs/4.2/eloquent#model-events
     */
    public static function boot() {
        parent::boot();

        static::updating(function($item) {
            if (isset($item->tree)) {
                if (isset($item->original[$item->parentColumn])
                        && $item->attributes[$item->parentColumn] != $item->original[$item->parentColumn]) {
                    $item->attributes['ancestors_cache'] = $item->generateAncestors($item->attributes['id']);
                    $item->attributes['descendants_cache'] = $item->generateDescendants($item->attributes['id']);
                }
            }
        });

        static::updated(function($item) {
            if (isset($item->tree)) {
                // regenerate ancestors and descendants
                if (!isset($item->original[$item->parentColumn])
                        || $item->attributes[$item->parentColumn] != $item->original[$item->parentColumn]) {
                    $ancestors = json_decode($item->attributes['ancestors_cache']);
                    if (isset($item->original['ancestors_cache'])
                            && json_decode($item->original['ancestors_cache']) != null) {
                        $ancestors = array_merge($ancestors, json_decode($item->original['ancestors_cache']));
                    }
                    $itemName = get_class($item);
                    foreach ($ancestors as $key=>$value) {
                        if ($value != $item->attributes['id']
                                && $value > 0) {
                            $new_item = $itemName::find($value);
                            $new_item->updateTreeOfItem($value);
                        }
                    }
                    $descendants = json_decode($item->attributes['descendants_cache']);
                    if (isset($item->original['descendants_cache'])
                            && json_decode($item->original['descendants_cache'])  != null) {
                        $descendants = array_merge($descendants, json_decode($item->original['descendants_cache']));
                    }
                    foreach ($descendants as $key=>$value) {
                        if ($value != $item->attributes['id']) {
                            $new_item = $itemName::find($value);
                            $new_item->updateTreeOfItem($value);
                        }
                    }
                }
            }
        });

        static::created(function($item) {
            if (isset($item->tree)) {
                // Manage the generation of ancestors
                $item->updateTreeOfItem($item->attributes['id']);
            }
        });
    }



    /**
     * function used to generate the ancestor cache
     *
     * @param integer $id id of the item
     *
     * @return string json with ancestors id
     */
    function generateAncestors($id) {
        if (empty($this->treeAllA)) {
            if (empty($this->treeAll)) {
                $itemName = get_class($this);
                $this->treeAll = $itemName::all(array('id', $this->parentColumn))->toArray();
            }
            foreach ($this->treeAll as $dat) {
                $this->treeAllA[$dat['id']] = $dat[$this->parentColumn];
            }
        }
        $ancestors = $this->getAncestors($this->treeAllA, $id);
        return json_encode($ancestors);
    }



    function getAncestors($dataWork, $id, $ancestors=array()) {
        $ancestors[] = $id;
        if (isset($dataWork[$id])) {
            $ancestors = $this->getAncestors($dataWork, $dataWork[$id], $ancestors);
        }
        return $ancestors;
    }



    function generateDescendants($id) {
        if (empty($this->treeAllD)) {
            if (empty($this->treeAll)) {
                $itemName = get_class($this);
                $this->treeAll = $itemName::all(array('id', $this->parentColumn))->toArray();
            }
            foreach ($this->treeAll as $dat) {
                $this->treeAllD[$dat[$this->parentColumn]][] = $dat['id'];
            }
        }
        $descendants = $this->getDescendants($this->treeAllD, $id);
        return json_encode($descendants);
    }




    function getDescendants($dataWork, $id, $descendants=array()) {
        $descendants[] = $id;
        if (isset($dataWork[$id])) {
            foreach ($dataWork[$id] as $id_d) {
                $descendants = $this->getDescendants($dataWork, $id_d, $descendants);
            }
        }
        return $descendants;
    }



    function updateTreeOfItem($id) {
        $this->ancestors_cache = $this->generateAncestors($id);
        $this->descendants_cache = $this->generateDescendants($id);
        $this->save();
    }
}