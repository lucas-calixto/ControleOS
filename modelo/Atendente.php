<?php

class Atendente {
    
    private $cod_atendente;
    private $nome_atendente;
    
    function getCod_atendente() {
        return $this->cod_atendente;
    }

    function getNome_atendente() {
        return $this->nome_atendente;
    }

    function setCod_atendente($cod_atendente) {
        $this->cod_atendente = $cod_atendente;
    }

    function setNome_atendente($nome_atendente) {
        $this->nome_atendente = $nome_atendente;
    }    
}
