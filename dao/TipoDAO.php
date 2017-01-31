<?php

require_once './banco/Banco.php';
require_once './modelo/Tipo.php';

class TipoDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Tipo $tipo) {
        try {
            $sql = "INSERT INTO tipos (desc_tipo) VALUES (:nome)";

            $parametros = array(
                ":nome" => $tipo->getDesc_tipo()

            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista() {
        try {
            $sql = "SELECT cod_tipo, desc_tipo FROM tipos";

            $tipos = [];
            $retorno = $this->banco->ExecuteQuery($sql);

            foreach ($retorno as $ln) {
                $tipo = new Tipo();
                $tipo->setCod_tipo($ln['cod_tipo']);
                $tipo->setDesc_tipo($ln['desc_tipo']);

                $tipos[] = $tipo;
            }

            return $tipos;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar(Tipo $tipo) {

        try {
            $sql = "UPDATE tipos SET desc_tipo = :nome WHERE cod_tipo = :cod";
            $parametros = array(
                ":nome" => $tipo->getDesc_tipo(),
                ":cod" => $tipo->getCod_tipo()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT cod_tipo, desc_tipo FROM tipos WHERE cod_tipo = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $tipo = new Tipo();
            $tipo->setCod_tipo($retorno['cod_tipo']);
            $tipo->setDesc_tipo($retorno['desc_tipo']);

            return $$tipo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function excluir($cod) {
        try {
            $sql = "DELETE FROM tipos WHERE cod_tipo = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQuery($sql, $parametros);

            return $retorno;
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
}
