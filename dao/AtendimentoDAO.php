<?php

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Atendimento.php';
require_once BASE_DIR . 'modelo' . DS . 'Tipo.php';
require_once BASE_DIR . 'modelo' . DS . 'Ordem.php';
require_once BASE_DIR . 'modelo' . DS . 'Tecnico.php';

class AtendimentoDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Atendimento $atendimento) {
        try {
            $sql = "INSERT INTO"
                    . " atendimentos"
                    . " (data_cad_atendimento, ordem_atendimento, nota_atendimento, os_resolve_atendimento, obs_atendimento)"
                    . " VALUES"
                    . " (NOW(), :cod_ordem, :nota_atendimento, :os_resolve, :obs);";
            
            $sql_dois = "UPDATE ordens SET status_ordem = 'FINALIZADA' WHERE cod_ondem = :cod_ordem_os";

            $parametros = array(
                ":cod_ordem" => $atendimento->getOrdem_atendimento()->getCod_ordem(),
                ":nota_atendimento" => $atendimento->getNota_atendimento(),
                ":os_resolve" => $atendimento->getOs_resolve_atendimento(),
                ":obs" => $atendimento->getObs_atendimento()
            );
            
            $parametros_cois = array(
                ":cod_ordem_os" => $atendimento->getOrdem_atendimento()->getCod_ordem()
            );

            $this->banco->ExecuteNonQuery($sql_dois, $parametros_cois);
            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista($inicio, $fim, $nome_cliente = "", $cidade_cliente = "") {
        try {
            $sql = "SELECT * FROM ordens"
                    . " INNER JOIN clientes ON ordens.cod_cliente_ordem = clientes.cod_cliente"
                    . " INNER JOIN tipos ON ordens.cod_tipo_ordem = tipos.cod_tipo"
                    . " WHERE (ordens.status_ordem LIKE 'BAIXADA')"
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

                $ordens[] = $ordem;
            }

            return $ordens;
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
            $cliente->setIp_cliente($retorno['ip_cliente']);
            $cliente->setUser_pppoe_cliente($retorno['user_pppoe_cliente']);
            $cliente->setPass_pppoe_cliente($retorno['pass_pppoe_cliente']);
            $cliente->setPlano_cliente($retorno['plano_cliente']);
            $ordem->setCod_cliente_ordem($cliente);

            $atendente->setNome_atendente($retorno['nome_atentente']);
            $ordem->setCod_atendente_ordem($atendente);

            $tecnico->setNome_tecnico($retorno['nome_tecnico']);
            $ordem->setCod_tecnico_ordem($tecnico);

            $tipo->setDesc_tipo($retorno['desc_tipo']);
            $ordem->setCod_tipo_ordem($tipo);

            $ordem->setDesc_ordem($retorno['desc_ordem']);
            $ordem->setData_cad_ordem($retorno['data_cad_ordem']);
            $ordem->setHora_cad_ordem($retorno['hora_cad_ordem']);
            $ordem->setStatus_ordem($retorno['status_ordem']);
            $ordem->setSolicitatante_ordem($retorno['solicita_ordem']);
            $ordem->setDesc_total_ordem($retorno['desc_total_ordem']);

            return $ordem;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
