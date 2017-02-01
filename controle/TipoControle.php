<?php

require_once './dao/TipoDAO.php';

class TipoControle {

    private $dao;

    function __construct() {
        $this->dao = new TipoDAO();
    }
    
    public function cadastra(Tipo $tipo) {
        if (trim(strlen($tipo->getDesc_tipo())) > 0) {
            return $this->dao->cadastra($tipo);
        } else {
            return false;
        }
    }
    
    public function lista($pag_inicio, $pag_fim) {
        return $this->dao->lista($pag_inicio, $pag_fim);
    }
    
    public function editar(Tipo $tipo) {
        if (trim(strlen($tipo->getDesc_tipo()))> 0) {
            return $this->dao->editar($tipo);
        } else {
            return false;
        }
    }

    public function busca($cod) { 
        return $this->dao->busca($cod);
    } 
    
    public function excluir($cod) { 
        return $this->dao->excluir($cod);
    } 
}
