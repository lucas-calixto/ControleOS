<?php

include_once 'modelo/Tipo.php';
include_once 'modelo/Cliente.php';
include_once 'modelo/Tecnico.php';
include_once 'modelo/Atendente.php';

class Ordem {

    private $cod_ordem;
    private $desc_ordem;
    private $data_cad_ordem;
    private $data_inicio_ordem;
    private $data_fim_ordem;
    private $hora_cad_ordem;
    private $hora_inicio_ordem;
    private $hora_fim_ordem;
    private $cod_tipo_ordem;
    private $cod_cliente_ordem;
    private $cod_tecnico_ordem;
    private $cod_atendente_ordem;
    private $desc_total_ordem;
    private $desc_resolve_ordem;
    private $status_ordem;
    private $solicitatante_ordem;

    function __construct() {
        $this->cod_tipo_ordem = new Tipo();
        $this->cod_cliente_ordem = new Cliente();
        $this->cod_tecnico_ordem = new Tecnico();
        $this->cod_atendente_ordem = new Atendente();
    }

    function getCod_ordem() {
        return $this->cod_ordem;
    }

    function getDesc_ordem() {
        return $this->desc_ordem;
    }

    function getData_cad_ordem() {
        return $this->data_cad_ordem;
    }

    function getData_inicio_ordem() {
        return $this->data_inicio_ordem;
    }

    function getData_fim_ordem() {
        return $this->data_fim_ordem;
    }

    function getHora_cad_ordem() {
        return $this->hora_cad_ordem;
    }

    function setHora_cad_ordem($hora_cad_ordem) {
        $this->hora_cad_ordem = $hora_cad_ordem;
    }

    function getHora_inicio_ordem() {
        return $this->hora_inicio_ordem;
    }

    function getHora_fim_ordem() {
        return $this->hora_fim_ordem;
    }

    function getCod_tipo_ordem() {
        return $this->cod_tipo_ordem;
    }

    function getCod_cliente_ordem() {
        return $this->cod_cliente_ordem;
    }

    function getCod_tecnico_ordem() {
        return $this->cod_tecnico_ordem;
    }

    function getCod_atendente_ordem() {
        return $this->cod_atendente_ordem;
    }

    function getDesc_total_ordem() {
        return $this->desc_total_ordem;
    }

    function getDesc_resolve_ordem() {
        return $this->desc_resolve_ordem;
    }

    function getStatus_ordem() {
        return $this->status_ordem;
    }

    function getSolicitatante_ordem() {
        return $this->solicitatante_ordem;
    }

    function setCod_ordem($cod_ordem) {
        $this->cod_ordem = $cod_ordem;
    }

    function setDesc_ordem($desc_ordem) {
        $this->desc_ordem = $desc_ordem;
    }

    function setData_cad_ordem($data_cad_ordem) {
        $this->data_cad_ordem = $data_cad_ordem;
    }

    function setData_inicio_ordem($data_inicio_ordem) {
        $this->data_inicio_ordem = $data_inicio_ordem;
    }

    function setData_fim_ordem($data_fim_ordem) {
        $this->data_fim_ordem = $data_fim_ordem;
    }

    function setHora_inicio_ordem($hora_inicio_ordem) {
        $this->hora_inicio_ordem = $hora_inicio_ordem;
    }

    function setHora_fim_ordem($hora_fim_ordem) {
        $this->hora_fim_ordem = $hora_fim_ordem;
    }

    function setCod_tipo_ordem($cod_tipo_ordem) {
        $this->cod_tipo_ordem = $cod_tipo_ordem;
    }

    function setCod_cliente_ordem($cod_cliente_ordem) {
        $this->cod_cliente_ordem = $cod_cliente_ordem;
    }

    function setCod_tecnico_ordem($cod_tecnico_ordem) {
        $this->cod_tecnico_ordem = $cod_tecnico_ordem;
    }

    function setCod_atendente_ordem($cod_atendente_ordem) {
        $this->cod_atendente_ordem = $cod_atendente_ordem;
    }

    function setDesc_total_ordem($desc_total_ordem) {
        $this->desc_total_ordem = $desc_total_ordem;
    }

    function setDesc_resolve_ordem($desc_resolve_ordem) {
        $this->desc_resolve_ordem = $desc_resolve_ordem;
    }

    function setStatus_ordem($status_ordem) {
        $this->status_ordem = $status_ordem;
    }

    function setSolicitatante_ordem($solicitatante_ordem) {
        $this->solicitatante_ordem = $solicitatante_ordem;
    }

}
