<?php

class Log {
    
    private $cod_log;
    private $data_log;
    private $hora_log;
    private $desc_log;
    
    function getCod_log() {
        return $this->cod_log;
    }

    function getData_log() {
        return $this->data_log;
    }

    function getHora_log() {
        return $this->hora_log;
    }

    function getDesc_log() {
        return $this->desc_log;
    }

    function setCod_log($cod_log) {
        $this->cod_log = $cod_log;
    }

    function setData_log($data_log) {
        $this->data_log = $data_log;
    }

    function setHora_log($hora_log) {
        $this->hora_log = $hora_log;
    }

    function setDesc_log($desc_log) {
        $this->desc_log = $desc_log;
    }
}