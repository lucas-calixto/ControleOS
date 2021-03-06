<?php

require_once BASE_DIR . 'dao' . DS . 'TecnicoDAO.php';

class TecnicoControle {

    private $dao;

    function __construct() {
        $this->dao = new TecnicoDAO();
    }
    
    public function cadastra(Tecnico $tecnico) {
        if (trim(strlen($tecnico->getNome_tecnico())) > 0) {
            return $this->dao->cadastra($tecnico);
        } else {
            return false;
        }
    }
    
    public function lista($inicio, $fim) {
        return $this->dao->lista($inicio, $fim);
    }
    
    public function editar(Tecnico $tecnico) {
        if (trim(strlen($tecnico->getNome_tecnico()))> 0) {
            return $this->dao->editar($tecnico);
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