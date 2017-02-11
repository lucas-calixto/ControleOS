<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Ordem.php';
require_once BASE_DIR . 'modelo' . DS . 'Cliente.php';

class ControleOS_DAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Ordem $ordem) {
        try {
            $sql = "INSERT INTO"
                    . " ordens"
                    . " (cod_atendente_ordem, cod_cliente_ordem, cod_tipo_ordem, desc_ordem, cod_tecnico_ordem, desc_total_ordem, status_ordem, solicita_ordem, data_cad_ordem)"
                    . " VALUES"
                    . " (:cod_atendente, :cod_cliente, :cod_tipo, :desc_ordem, :cod_tecnico, :desc_total, :status_ordem, :solicita_ordem, NOW())";

            $parametros = array(
                ":cod_atendente" => $ordem->getCod_atendente_ordem(),
                ":cod_cliente" => $ordem->getCod_cliente_ordem(),
                ":cod_tipo" => $ordem->getCod_tipo_ordem(),
                ":desc_ordem" => $ordem->getDesc_ordem(),
                ":cod_tecnico" => $ordem->getCod_tecnico_ordem(),
                ":desc_total" => $ordem->getDesc_total_ordem(),
                ":status_ordem" => $ordem->getStatus_ordem(),
                ":solicita_ordem" => $ordem->getSolicitatante_ordem()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista($inicio, $fim) {
        try {
            $sql = "SELECT * FROM ordens"
                    . " INNER JOIN clientes ON ordens.cod_cliente_ordem = clientes.cod_cliente"
                    . " ORDER BY data_cad_ordem DESC"
                    . " LIMIT :inicio, :fim";

            $parametros = array(
                ":inicio" => $inicio,
                ":fim" => $fim
            );

            $ordens = [];
            $retorno = $this->banco->ExecuteQuery($sql, $parametros);

            foreach ($retorno as $ln) {
                $ordem = new Ordem();
                $cliente = new Cliente();

                $ordem->setCod_ordem($ln['cod_ondem']);
                $cliente->setNome_cliente($ln['nome_cliente']);
                $ordem->setCod_cliente_ordem($cliente);
                $ordem->setDesc_ordem($ln['desc_ordem']);
                $ordem->setData_cad_ordem($ln['data_cad_ordem']);
                $ordem->setStatus_ordem($ln['status_ordem']);

                $ordens[] = $ordem;
            }

            return $ordens;
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
            $sql = "SELECT * FROM ordens"
                    . " WHERE ordens.csod_ordem = :cod"
;

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $ordem = new Ordem();
            //$cliente = new Cliente();

            $ordem->setCod_ordem($retorno['cod_ondem']);
            //$cliente->setCod_cliente($retorno['cod_cliente']);
            //$cliente->setNome_cliente($retorno['nome_cliente']);
            //$ordem->setCod_cliente_ordem($cliente);
            $ordem->setDesc_ordem($retorno['desc_ordem']);
            $ordem->setData_cad_ordem($retorno['data_cad_ordem']);
            $ordem->setStatus_ordem($retorno['status_ordem']);

            echo $ordem->getCod_ordem();
            
            return $ordem;
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