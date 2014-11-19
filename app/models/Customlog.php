<?php

class Customlog {

    protected $log;

    public function __construct($log) {
        $this->log = $log;
    }


    /**
     * Write message
     * @param  mixed     $message
     * @param  int       $level
     * @return int|bool
     */
    public function write($message, $level = null) {

        $oClass = new ReflectionClass ('\Slim\Log');
        $logConstants = array_flip($oClass->getConstants());

        $resource = fopen(__DIR__.'/../log/glpi_'.$logConstants[$level].'.log', 'a');

        return fwrite($resource, (string) $message . PHP_EOL);
    }

}