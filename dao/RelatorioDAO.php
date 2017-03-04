<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Tipo.php';
require_once BASE_DIR . 'modelo' . DS . 'Ordem.php';
require_once BASE_DIR . 'modelo' . DS . 'Tecnico.php';
require_once BASE_DIR . 'modelo' . DS . 'Cliente.php';
require_once BASE_DIR . 'modelo' . DS . 'Atendente.php';


class RelatorioDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }
    
public function lista($inicio, $fim, $nome_cliente = "", $cidade_cliente = "") {
        try {
            $sql = "SELECT * FROM ordens"
                    . " INNER JOIN clientes ON ordens.cod_cliente_ordem = clientes.cod_cliente"
                    . " INNER JOIN tipos ON ordens.cod_tipo_ordem = tipos.cod_tipo"
                    . " WHERE (ordens.status_ordem NOT LIKE 'ABERTA')"
                    . " AND (clientes.nome_cliente LIKE '%" . $nome_cliente . "%'"
                    . " AND clientes.cod_cidade_cliente LIKE '%" . $cidade_cliente . "%')"
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
                $tipo = new Tipo();

                $tipo->setDesc_tipo($ln['desc_tipo']);
                $ordem->setCod_tipo_ordem($tipo);

                $ordem->setCod_ordem($ln['cod_ondem']);
                $cliente->setNome_cliente($ln['nome_cliente']);
                $ordem->setCod_cliente_ordem($cliente);
                $ordem->setDesc_ordem($ln['desc_ordem']);
                $ordem->setData_cad_ordem($ln['data_cad_ordem']);
                $ordem->setHora_cad_ordem($ln['hora_cad_ordem']);
                $ordem->setStatus_ordem($ln['status_ordem']);
                $ordem->setDesc_total_ordem($ln['desc_total_ordem']);
                $ordem->setCod_tecnico_ordem($ln['cod_tecnico_ordem']);
                $ordem->setHora_inicio_ordem($ln['hora_inicio_ordem']);
                $ordem->setHora_fim_ordem($ln['hora_fim_ordem']);
                $ordem->setDesc_resolve_ordem($ln['desc_resolve_ordem']);

                $ordens[] = $ordem;
            }

            return $ordens;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getTotalOSMes() {

        try {
            $sql = "SELECT data_cad_ordem FROM ordens";

            $retorno = $this->banco->ExecuteQuery($sql);
            $cont = 0;

            foreach ($retorno as $ln) {
                $data = date("m", strtotime($ln['data_cad_ordem']));
                $mes = date("m");

                if (!strcmp($data, $mes)) {
                    $cont++;
                }
            }

            return $cont;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getCancelamentoMes() {
        try {
            $sql = "SELECT * FROM ordens INNER JOIN tipos ON ordens.cod_tipo_ordem = tipos.cod_tipo";

            $retorno = $this->banco->ExecuteQuery($sql);
            $cont = 0;

            foreach ($retorno as $ln) {
                $data = date("m", strtotime($ln['data_cad_ordem']));
                $mes = date("m");

                $tipo = $ln['desc_tipo'];

                if (!strcmp($data, $mes) and ! strcmp($tipo, 'CANCELAMENTO')) {
                    $cont++;
                }
            }

            return $cont;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAtivacaoMes() {
        try {
            $sql = "SELECT ordens.cod_tipo_ordem, ordens.data_cad_ordem, tipos.cod_tipo, tipos.desc_tipo FROM ordens INNER JOIN tipos ON ordens.cod_tipo_ordem = tipos.cod_tipo";

            $retorno = $this->banco->ExecuteQuery($sql);
            $cont = 0;

            foreach ($retorno as $ln) {
                $data = date("m", strtotime($ln['data_cad_ordem']));
                $mes = date("m");

                $tipo = $ln['desc_tipo'];

                if (!strcmp($data, $mes) and ! strcmp($tipo, 'ATIVAÇÃO')) {
                    $cont++;
                }
            }

            return $cont;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getTempoMedioOSMes() {
        try {
            $sql = "SELECT * FROM ordens WHERE status_ordem LIKE 'BAIXADA'";

            $retorno = $this->banco->ExecuteQuery($sql);
            $cont = 0;
            $tempo = 0;

            foreach ($retorno as $ln) {
                $data = date("m", strtotime($ln['data_cad_ordem']));
                $mes = date("m");

                if (!strcmp($data, $mes)) {
                    $horaInicio = (date("G", strtotime($ln['hora_inicio_ordem'])) * 60) + date("i", strtotime($ln['hora_inicio_ordem']));
                    $horaFim = (date("G", strtotime($ln['hora_fim_ordem'])) * 60) + date("i", strtotime($ln['hora_fim_ordem']));
                    
                    $tempoOrdem = $horaFim - $horaInicio;

                    $tempo = $tempo + $tempoOrdem;

                    $cont++;
                }
            }


            return $tempo / $cont;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}