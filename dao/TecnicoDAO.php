<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Tecnico.php';

class TecnicoDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Tecnico $tecnico) {
        try {
            $sql = "INSERT INTO tecnicos (nome_tecnico) VALUES (:nome)";

            $parametros = array(
                ":nome" => $tecnico->getNome_tecnico()

            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista($inicio, $fim) {
        try {
            $sql = "SELECT cod_tecnico, nome_tecnico FROM tecnicos LIMIT :inicio, :fim";

            $parametros = array (
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            
            $tecnicos = [];
            $retorno = $this->banco->ExecuteQuery($sql, $parametros);

            foreach ($retorno as $ln) {
                $tecnico = new Tecnico();
                $tecnico->setCod_tecnico($ln['cod_tecnico']);
                $tecnico->setNome_tecnico($ln['nome_tecnico']);

                $tecnicos[] = $tecnico;
            }

            return $tecnicos;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar(Tecnico $tecnico) {

        try {
            $sql = "UPDATE tecnicos SET nome_tecnico = :nome WHERE cod_tecnico = :cod";
            $parametros = array(
                ":nome" => $tecnico->getNome_tecnico(),
                ":cod" => $tecnico->getCod_tecnico()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT cod_tecnico, nome_tecnico FROM tecnicos WHERE cod_tecnico = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $tecnico = new Tecnico();
            $tecnico->setCod_tecnico($retorno['cod_tecnico']);
            $tecnico->setNome_tecnico($retorno['nome_tecnico']);

            return $tecnico;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function excluir($cod) {
        try {
            $sql = "DELETE FROM tecnicos WHERE cod_tecnico = :cod";

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
