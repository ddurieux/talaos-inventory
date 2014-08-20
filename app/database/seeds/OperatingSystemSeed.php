<?php

class OperatingSystemSeed {

    function run()
    {
        $operatingsystem = new OperatingSystem;
        $operatingsystem->name = "Test FreeBSD";
        $operatingsystem->save();
    }
}
