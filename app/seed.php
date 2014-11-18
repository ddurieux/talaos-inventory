<?php

// Autoload our dependencies with Composer
require 'vendor/autoload.php';
require 'app/dbmodels.php';


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


        // Asset
        for ($i=1; $i < 2000; $i++) {
            $asset = new Asset;
            $type = mt_rand(0, (count($assettypes) - 1));
            $state = mt_rand(0, (count($states) - 1));
            $asset->name = $assettypes[$type].$i;
            $asset->assettype_id = $type;
            $asset->state_id = $state;
            $asset->save();
        }
    }
}