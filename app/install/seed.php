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
//        $this->createLocation(1, 'loc', new Location());

        // Entity
        $root = Entity::create(['name' => 'root']);
        $entA = Entity::create(['name' => 'ent_A']);
        $entA->makeChildOf($root);
        $entA1 = Entity::create(['name' => 'ent_A1']);
        $entA1->makeChildOf($entA);

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
        if ($depth > 5) {
            return;
        }
        for ($i=0;$i< ($depth * 2); $i++) {
            $loc = Location::create(['name' => $name.'.'.$depth.$i]);
            if ($depth > 1) {
                $loc->makeChildOf($item);
            }
            $this->createLocation(($depth + 1), $name.'.'.$depth.$i, $loc);
        }
   }
}
