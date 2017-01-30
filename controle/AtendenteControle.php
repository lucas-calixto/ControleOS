<?php

require_once './dao/AtendenteDAO.php';

class AtendenteControle {

    private $dao;

    function __construct() {
        $this->dao = new AtendenteDAO();
    }
    
    public function cadastra(Atendente $atendente) {
        if (trim(strlen($atendente->getNome_atendente())) > 0) {
            return $this->dao->cadastra($atendente);
        } else {
            return false;
        }
    }
    
    public function lista() {
        return $this->dao->lista();
    }
    
    public function editar(Atendente $atendente) {
        if (trim(strlen($atendente->getNome_atendente()))> 0) {
            return $this->dao->editar($atendente);
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
