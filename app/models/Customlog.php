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
        global $statsd;

        $oClass = new ReflectionClass ('\Slim\Log');
        $logConstants = array_flip($oClass->getConstants());

        $a = $this->rewriteError($logConstants[$level], $message);
        $a['error']['date']   = date("Ymd H:i:s");
        $a['error']['url']    = $_SERVER['REQUEST_URI'];
        $a['error']['method'] = $_SERVER['REQUEST_METHOD'];

        $resource = fopen(__DIR__.'/../log/glpi_'.$logConstants[$level].'.log', 'a');

        http_response_code(404);
        fwrite($resource, print_r($a, true) . PHP_EOL);
        echo json_encode($a, JSON_PRETTY_PRINT);
        $statsd->increment("error");
        $statsd->increment("page");
        exit;
    }



    function rewriteError($type, $message) {

        $a = array('error' => array());

        switch ($type) {

            case 'ERROR':
                if (strstr($message, 'SQLSTATE[42S22]')) {
                    $split = explode("\n\n", $message);
                    $split2 = explode("Stack trace:", $split[1]);
                    $a['error']['type'] = 'SQLSTATE';
                    $a['error']['number'] = '42S22';
                    $a['error']['message'] = trim($split2[0]);
                    $a['error']['stacktrace'] = $this->stackTrace($split2[1]);
                } else if (preg_match("/([A-Z]+)\[([0-9]+)\]:/", $message)) {
                    $matches = array();
                    preg_match("/([A-Z]+)\[([0-9]+)\]:/", $message, $matches);
                    $split2 = explode("Stack trace:", $message);
                    $a['error']['type'] = $matches[1];
                    $a['error']['number'] = $matches[2];
                    $a['error']['message'] = trim($split2[0]);
                    $a['error']['stacktrace'] = $this->stackTrace($split2[1]);
                }
                break;


            case 'NOTICE':
                if (preg_match("/([A-Z]+)\[([0-9]+)\]:/", $message)) {
                    $matches = array();
                    preg_match("/([A-Z]+)\[([0-9]+)\]:/", $message, $matches);
                    $split2 = explode("Stack trace:", $message);
                    $a['error']['type'] = $matches[1];
                    $a['error']['number'] = $matches[2];
                    $a['error']['message'] = trim($split2[0]);
                    $a['error']['stacktrace'] = $this->stackTrace($split2[1]);
                }
                break;

        }
        return $a;
    }



    function stackTrace($trace) {
        $a = array();
        $split = explode("\n", $trace);
        foreach ($split as $line) {
            $matches = array();
            preg_match("/#([0-9]+) (.*)/", $line, $matches);
            if (count($matches) > 2) {
                $a['#'.$matches[1]] = $matches[2];
            }
        }
        return $a;
    }
}