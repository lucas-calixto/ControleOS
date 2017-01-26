<?php

require_once './dao/UsuarioDAO.php';

class UsuarioControle {

    private $dao;

    function __construct() {
        $this->dao = new UsuarioDAO();
    }

    public function cadastra(Usuario $usuario) {

        if (trim(strlen($usuario->getNome_usuario()) > 0) && trim(strlen($usuario->getLogin_usuario()) > 0) && trim(strlen($usuario->getSenha_usuario()) > 0)) {
            
            return $this->dao->cadastra($usuario);
        } else {
            
            return false;
        }
    }
    
    public function lista() {
        return $this->dao->lista();
    }
    
    public function editar(Usuario $usuario) {
        
        if (trim(strlen($usuario->getNome_usuario()) > 0) && trim(strlen($usuario->getLogin_usuario()) > 0) && trim(strlen($usuario->getSenha_usuario()) > 0)) {
            
            return $this->dao->editar($usuario);
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
