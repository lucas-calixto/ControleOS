<?php

require_once './dao/TecnicoDAO.php';

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
    
    public function lista() {
        return $this->dao->lista();
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