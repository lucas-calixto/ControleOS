<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Atendente.php';

class AtendenteDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Atendente $atendente) {
        try {
            $sql = "INSERT INTO atendentes (nome_atentente) VALUES (:nome)";

            $parametros = array(
                ":nome" => $atendente->getNome_atendente()

            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista($inicio, $fim) {
        try {
            $sql = "SELECT cod_atendente, nome_atentente FROM atendentes LIMIT :inicio, :fim";

            $atendentes = [];
            
            $parametros = array (
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            
            $retorno = $this->banco->ExecuteQuery($sql, $parametros);

            foreach ($retorno as $ln) {
                $atendente = new Atendente();
                $atendente->setCod_atendente($ln['cod_atendente']);
                $atendente->setNome_atendente($ln['nome_atentente']);

                $atendentes[] = $atendente;
            }

            return $atendentes;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar(Atendente $atendente) {

        try {
            $sql = "UPDATE atendentes SET nome_atentente = :nome WHERE cod_atendente = :cod";
            $parametros = array(
                ":nome" => $atendente->getNome_atendente(),
                ":cod" => $atendente->getCod_atendente()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT cod_atendente, nome_atentente FROM atendentes WHERE cod_atendente = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $atendente = new Atendente();
            $atendente->setCod_atendente($retorno['cod_atendente']);
            $atendente->setNome_atendente($retorno['nome_atentente']);

            return $atendente;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function excluir($cod) {
        try {
            $sql = "DELETE FROM atendentes WHERE cod_atendente = :cod";

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
