<?php

require_once './banco/Banco.php';
require_once './modelo/Ordem.php';
require_once './modelo/Cliente.php';

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
            $sql = "INSERT INTO ordens VALUES (:desc_ordem, data_cad_ordem, data_inicio_ordem,"
                    . "data_fim_ordem, hora_cad_ordem, hora_inicio_ordem, hora_fim_ordem,"
                    . "cod_tipo_ordem, cod_cliente_ordem, cod_tecnico_ordem, cod_atendente_ordem,"
                    . "desc_total_ordem, desc_resolve_ordem, status_ordem, solicita_ordem)";

            $parametros = array(
                ":desc_ordem" => $ordem->getDesc_ordem(),
                ":data_cad_ordem" => $ordem->getData_cad_ordem(),
                ":data_inicio_ordem" => $ordem->getData_inicio_ordem(),
                ":data_fim_ordem" => $ordem->getData_fim_ordem(),
                ":hora_cad_ordem" => $ordem->getHora_cad_ordem(),
                ":hora_inicio_ordem" => $ordem->getHora_inicio_ordem(),
                ":hora_fim_ordem" => $ordem->getHora_fim_ordem(),
                ":cod_tipo_ordem" => $ordem->getCod_tipo_ordem(),
                ":cod_cliente_ordem" => $ordem->getCod_cliente_ordem(),
                ":cod_tecnico_ordem" => $ordem->getCod_tecnico_ordem(),
                ":cod_atendente_ordem" => $ordem->getCod_atendente_ordem(),
                ":desc_total_ordem" => $ordem->getDesc_total_ordem(),
                ":desc_resolve_ordem" => $ordem->getDesc_resolve_ordem(),
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
