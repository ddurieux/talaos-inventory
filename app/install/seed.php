<?php

class Seed {

    function run() {

        // * AssetType
        $assettypes = array('Computer', 'Server', 'Laptop', 'Blade', 'Switch', 'Router', 'Rack', 'Smartphone');
        foreach ($assettypes as $val) {
            $assettype = new AssetType;
            $assettype->name = $val;
            $assettype->save();
        }

        // State
        $states = array('En panne', 'En service', 'Stock', 'Sortie de parc');
        foreach ($states as $val) {
            $state = new State;
            $state->name = $val;
            $state->save();
        }

        // Location
        $this->createLocation(1, 'loc', new Location());

        // Entity
        $entity = new Entity;
        $entity->name = 'root';
        $entity->save();

        $entity = new Entity;
        $entity->name = 'ent_A';
        $entity->entity_id = 1;
        $entity->save();

        $entity = new Entity;
        $entity->name = 'ent_A1';
        $entity->entity_id = 2;
        $entity->save();

        // Asset
        for ($i=1; $i < 2000; $i++) {
            $asset = new Asset;
            $type = mt_rand(0, (count($assettypes) - 1));
            $state = mt_rand(0, (count($states) - 1));
            $entity = mt_rand(1, 3);
            $asset->name = $assettypes[$type].$i;
            $asset->asset_type_id = $type;
            $asset->state_id = $state;
            $asset->entity_id = $entity;
            $asset->save();
        }
    }


    /**
     * Generate 4282 locations on 5 levels
     *
     * @param type $depth
     * @param type $name
     * @param type $item
     * @return type
     */
    function createLocation($depth, $name, $item) {
        if ($depth > 4) {
            return;
        }
        for ($i=0;$i< ($depth * 2); $i++) {
            $loc = new Location;
            $loc->name = $name.'.'.$depth.$i;
            $loc->entity_id = 1;
            if ($depth > 1) {
                $loc->location_id = $item->id;
            }
            $loc->save();
            $this->createLocation(($depth + 1), $name.'.'.$depth.$i, $loc);
        }
   }
}
