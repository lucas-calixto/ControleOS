<?php

include_once 'Ordem.php';

class Atendimento {

    private $cod_atendimento;
    private $data_cad_atendimento;
    private $ordem_atendimento;
    private $nota_atendimento;
    private $os_resolve_atendimento;
    private $obs_atendimento;

    function __construct() {
        $this->ordem_atendimento = new Ordem();
    }
    
    function getCod_atendimento() {
        return $this->cod_atendimento;
    }

    function getData_cad_atendimento() {
        return $this->data_cad_atendimento;
    }

    function getOrdem_atendimento() {
        return $this->ordem_atendimento;
    }

    function getNota_atendimento() {
        return $this->nota_atendimento;
    }

    function getOs_resolve_atendimento() {
        return $this->os_resolve_atendimento;
    }

    function getObs_atendimento() {
        return $this->obs_atendimento;
    }

    function setCod_atendimento($cod_atendimento) {
        $this->cod_atendimento = $cod_atendimento;
    }

    function setData_cad_atendimento($data_cad_atendimento) {
        $this->data_cad_atendimento = $data_cad_atendimento;
    }

    function setOrdem_atendimento($ordem_atendimento) {
        $this->ordem_atendimento = $ordem_atendimento;
    }

    function setNota_atendimento($nota_atendimento) {
        $this->nota_atendimento = $nota_atendimento;
    }

    function setOs_resolve_atendimento($os_resolve_atendimento) {
        $this->os_resolve_atendimento = $os_resolve_atendimento;
    }

    function setObs_atendimento($obs_atendimento) {
        $this->obs_atendimento = $obs_atendimento;
    }
    
}