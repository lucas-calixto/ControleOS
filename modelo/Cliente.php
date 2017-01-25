<?php

require_once 'Cidade.php';

class Cliente {

    private $cod_cliente;
    private $cod_pers_cliente;
    private $nome_cliente;
    private $endereco_cliente;
    private $bairro_cliente;
    private $cod_cidade_cliente;
    private $telefone_um_cliente;
    private $telefone_dois_cliente;
    private $ip_cliente;
    private $pop_cliente;
    private $user_pppoe_cliente;
    private $pass_pppoe_cliente;
    private $plano_cliente;
    
    function __construct() {
        $this->cod_cidade_cliente = new Cliente();
    }
    
    function getCod_cliente() {
        return $this->cod_cliente;
    }

    function getCod_pers_cliente() {
        return $this->cod_pers_cliente;
    }

    function getNome_cliente() {
        return $this->nome_cliente;
    }

    function getEndereco_cliente() {
        return $this->endereco_cliente;
    }

    function getBairro_cliente() {
        return $this->bairro_cliente;
    }

    function getCod_cidade_cliente() {
        return $this->cod_cidade_cliente;
    }

    function getTelefone_um_cliente() {
        return $this->telefone_um_cliente;
    }

    function getTelefone_dois_cliente() {
        return $this->telefone_dois_cliente;
    }

    function getIp_cliente() {
        return $this->ip_cliente;
    }

    function getPop_cliente() {
        return $this->pop_cliente;
    }

    function getUser_pppoe_cliente() {
        return $this->user_pppoe_cliente;
    }

    function getPass_pppoe_cliente() {
        return $this->pass_pppoe_cliente;
    }

    function setCod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    function setCod_pers_cliente($cod_pers_cliente) {
        $this->cod_pers_cliente = $cod_pers_cliente;
    }

    function setNome_cliente($nome_cliente) {
        $this->nome_cliente = $nome_cliente;
    }

    function setEndereco_cliente($endereco_cliente) {
        $this->endereco_cliente = $endereco_cliente;
    }

    function setBairro_cliente($bairro_cliente) {
        $this->bairro_cliente = $bairro_cliente;
    }

    function setCod_cidade_cliente($cod_cidade_cliente) {
        $this->cod_cidade_cliente = $cod_cidade_cliente;
    }

    function setTelefone_um_cliente($telefone_um_cliente) {
        $this->telefone_um_cliente = $telefone_um_cliente;
    }

    function setTelefone_dois_cliente($telefone_dois_cliente) {
        $this->telefone_dois_cliente = $telefone_dois_cliente;
    }

    function setIp_cliente($ip_cliente) {
        $this->ip_cliente = $ip_cliente;
    }

    function setPop_cliente($pop_cliente) {
        $this->pop_cliente = $pop_cliente;
    }

    function setUser_pppoe_cliente($user_pppoe_cliente) {
        $this->user_pppoe_cliente = $user_pppoe_cliente;
    }

    function setPass_pppoe_cliente($pass_pppoe_cliente) {
        $this->pass_pppoe_cliente = $pass_pppoe_cliente;
    }
    
    function getPlano_cliente() {
        return $this->plano_cliente;
    }

    function setPlano_cliente($plano_cliente) {
        $this->plano_cliente = $plano_cliente;
    }
}