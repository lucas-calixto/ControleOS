<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Cliente.php';

class ClienteDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function lista() {
        try {
            $sql = "SELECT cod_cliente, nome_cliente, cod_pers_cliente FROM clientes";

            $clientes = [];

            $retorno = $this->banco->ExecuteQuery($sql);

            foreach ($retorno as $ln) {
                $cliente = new Cliente();
                $cliente->setCod_cliente($ln['cod_cliente']);
                $cliente->setNome_cliente($ln['nome_cliente']);
                $cliente->setCod_pers_cliente($ln['cod_pers_cliente']);

                $clientes[] = $cliente;
            }

            return $clientes;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT cod_cliente, nome_cliente FROM clientes WHERE cod_cliente = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $cliente = new Cliente();
            $cliente->setCod_cliente($retorno['cod_cliente']);
            $cliente->setNome_cliente($retorno['nome_cliente']);

            return $cliente;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function buscaDinamica($consulta) {
        try {
            $sql = "SELECT * FROM clientes WHERE nome_cliente LIKE '%" . $consulta . "%'";

            $nomes = [];
            
            $retorno = $this->banco->ExecuteQuery($sql);

            foreach ($retorno as $ln) {
                
                $nomeCliente = $ln['nome_cliente'];

                $nomes[] = $nomeCliente;
            }

            return $nomes;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
