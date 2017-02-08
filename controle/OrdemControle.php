<?php

require_once './dao/ControleOS_DAO.php';

class OrdemControle {

    private $dao;

    function __construct() {
        $this->dao = new ControleOS_DAO();
    }

    public function cadastra() {

    }
    
    public function lista($inicio, $fim) {
        return $this->dao->lista($inicio, $fim);
    }
    
    public function editar() {
        
    }

    public function busca($cod) { 
        return $this->dao->busca($cod);
    } 
    
    public function excluir($cod) { 
        return $this->dao->excluir($cod);
    } 
}
