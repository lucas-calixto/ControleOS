<?php

class Tecnico {
    
    private $cod_tecnico;
    private $nome_tecnico;
    
    function getCod_tecnico() {
        return $this->cod_tecnico;
    }

    function getNome_tecnico() {
        return $this->nome_tecnico;
    }

    function setCod_tecnico($cod_tecnico) {
        $this->cod_tecnico = $cod_tecnico;
    }

    function setNome_tecnico($nome_tecnico) {
        $this->nome_tecnico = $nome_tecnico;
    }
}
