<?php

class Cidade {
    
    private $cod_cidade;
    private $desc_cidade;
    
    function getCod_cidade() {
        return $this->cod_cidade;
    }

    function getDesc_cidade() {
        return $this->desc_cidade;
    }

    function setCod_cidade($cod_cidade) {
        $this->cod_cidade = $cod_cidade;
    }

    function setDesc_cidade($desc_cidade) {
        $this->desc_cidade = $desc_cidade;
    }

}