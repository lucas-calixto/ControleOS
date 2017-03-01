<?php

require_once BASE_DIR . 'dao' . DS . 'AtendimentoDAO.php';

class AtendimentoControle {

    private $dao;

    function __construct() {
        $this->dao = new AtendimentoDAO();
    }

    public function cadastra(Atendimento $atendimento) {
        return $this->dao->cadastra($atendimento);
    }
    
    public function lista($inicio, $fim, $nome_cliente = "", $cidade_cliente = "") {
        return $this->dao->lista($inicio, $fim, $nome_cliente, $cidade_cliente);
    }

    public function busca($cod) { 
        return $this->dao->busca($cod);
    } 
    
}
