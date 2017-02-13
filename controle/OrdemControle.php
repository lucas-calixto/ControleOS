<?php

require_once BASE_DIR . 'dao' . DS . 'ControleOS_DAO.php';

class OrdemControle {

    private $dao;

    function __construct() {
        $this->dao = new ControleOS_DAO();
    }

    public function cadastra(Ordem $ordem) {
        return $this->dao->cadastra($ordem);
    }
    
    public function lista($inicio, $fim) {
        return $this->dao->lista($inicio, $fim);
    }
    
    public function editar(Ordem $ordem) {
        return $this->dao->editar($ordem);
    }

    public function busca($cod) { 
        return $this->dao->busca($cod);
    } 
    
    public function excluir($cod) { 
        return $this->dao->excluir($cod);
    } 
    
    public function baixar($cod) { 
        return $this->dao->baixar($cod);
    } 
}
