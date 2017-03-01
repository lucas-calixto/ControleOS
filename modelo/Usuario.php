<?php

class Usuario {
    
    private $cod_usuario;
    private $nome_usuario;
    private $login_usuario;
    private $senha_usuario;
    private $cidade_usuario;
    
    
    function getCod_usuario() {
        return $this->cod_usuario;
    }

    function getNome_usuario() {
        return $this->nome_usuario;
    }

    function getLogin_usuario() {
        return $this->login_usuario;
    }

    function getSenha_usuario() {
        return $this->senha_usuario;
    }

    function setCod_usuario($cod_usuario) {
        $this->cod_usuario = $cod_usuario;
    }

    function setNome_usuario($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    function setLogin_usuario($login_usuario) {
        $this->login_usuario = $login_usuario;
    }

    function setSenha_usuario($senha_usuario) {
        $this->senha_usuario = $senha_usuario;
    }
    
    function getCidade_usuario() {
        return $this->cidade_usuario;
    }

    function setCidade_usuario($cidade_usuario) {
        $this->cidade_usuario = $cidade_usuario;
    }

}