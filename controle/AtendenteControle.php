<?php

require_once BASE_DIR . 'dao' . DS . 'AtendenteDAO.php';

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
    
    public function lista($inicio, $fim) {
        return $this->dao->lista($inicio, $fim);
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
