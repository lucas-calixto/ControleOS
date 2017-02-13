<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Tipo.php';
require_once BASE_DIR . 'modelo' . DS . 'Ordem.php';
require_once BASE_DIR . 'modelo' . DS . 'Tecnico.php';
require_once BASE_DIR . 'modelo' . DS . 'Cliente.php';
require_once BASE_DIR . 'modelo' . DS . 'Atendente.php';

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
                    . " WHERE ordens.status_ordem LIKE 'ABERTA' OR ordens.status_ordem LIKE 'ANDAMENTO'"
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
                $ordem->setDesc_total_ordem($ln['desc_total_ordem']);
                $ordem->setCod_tecnico_ordem($ln['cod_tecnico_ordem']);

                $ordens[] = $ordem;
            }

            return $ordens;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar(Ordem $ordem) {
        try {
            $sql = "UPDATE ordens SET"
                    . " desc_total_ordem = :desc, cod_tecnico_ordem = :cod_tecnico, status_ordem = :status"
                    . " WHERE cod_ondem = :cod";

            $parametros = array(
                ":desc" => $ordem->getDesc_total_ordem(),
                ":status" => $ordem->getStatus_ordem(),
                ":cod" => $ordem->getCod_ordem(),
                "cod_tecnico" => $ordem->getCod_tecnico_ordem()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT * FROM ordens"
                    . " INNER JOIN clientes ON ordens.cod_cliente_ordem = clientes.cod_cliente"
                    . " INNER JOIN atendentes ON ordens.cod_atendente_ordem = atendentes.cod_atendente"
                    . " INNER JOIN tecnicos ON ordens.cod_tecnico_ordem = tecnicos.cod_tecnico"
                    . " INNER JOIN tipos ON ordens.cod_tipo_ordem = tipos.cod_tipo"
                    . " WHERE cod_ondem = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $tipo = new Tipo();
            $ordem = new Ordem();
            $tecnico = new Tecnico();
            $cliente = new Cliente();
            $atendente = new Atendente();

            $ordem->setCod_ordem($retorno['cod_ondem']);

            $cliente->setCod_cliente($retorno['cod_cliente']);
            $cliente->setNome_cliente($retorno['nome_cliente']);
            $cliente->setTelefone_um_cliente($retorno['telefone_um_cliente']);
            $cliente->setEndereco_cliente($retorno['endereco_cliente']);
            $ordem->setCod_cliente_ordem($cliente);

            $atendente->setNome_atendente($retorno['nome_atentente']);
            $ordem->setCod_atendente_ordem($atendente);

            $tecnico->setNome_tecnico($retorno['nome_tecnico']);
            $ordem->setCod_tecnico_ordem($tecnico);

            $tipo->setDesc_tipo($retorno['desc_tipo']);
            $ordem->setCod_tipo_ordem($tipo);

            $ordem->setDesc_ordem($retorno['desc_ordem']);
            $ordem->setData_cad_ordem($retorno['data_cad_ordem']);
            $ordem->setStatus_ordem($retorno['status_ordem']);
            $ordem->setSolicitatante_ordem($retorno['solicita_ordem']);
            $ordem->setDesc_total_ordem($retorno['desc_total_ordem']);

            return $ordem;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluir($cod) {
        try {
            $sql = "UPDATE ordens SET status_ordem = 'EXCLUIDA' WHERE cod_ondem = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function baixar(Ordem $ordem) {
        try {
            $sql = "UPDATE ordens"
                    . " SET status_ordem = 'BAIXADA', desc_resolve_ordem = :desc_resolve"
                    . " WHERE cod_ondem = :cod";

            $parametros = array(
                ":cod" => $ordem->getCod_ordem(),
                ":desc_resolve" => $ordem->getDesc_resolve_ordem()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
