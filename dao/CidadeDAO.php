<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Cidade.php';

class CidadeDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function listar() {

        try {
            $sql = "SELECT * FROM cidades";

            $cidades= [];

            $retorno = $this->banco->ExecuteQuery($sql);

            foreach ($retorno as $ln) {
                $cidade = new Cidade();
                
                $cidade->setCod_cidade($ln['cod_cidade']);
                $cidade->setDesc_cidade($ln['desc_cidade']);

                $cidades[] = $cidade;
            }

            return $cidades;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
