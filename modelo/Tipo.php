<?php

class Tipo {
    
    private $cod_tipo;
    private $desc_tipo;
    
    function getCod_tipo() {
        return $this->cod_tipo;
    }

    function getDesc_tipo() {
        return $this->desc_tipo;
    }

    function setCod_tipo($cod_tipo) {
        $this->cod_tipo = $cod_tipo;
    }

    function setDesc_tipo($desc_tipo) {
        $this->desc_tipo = $desc_tipo;
    }
}
