<?php

class ComputerSeed {

    function run()
    {
        $computer = new Computer;
        $computer->name = "Test Computer";
        $computer->save();
    }
}
