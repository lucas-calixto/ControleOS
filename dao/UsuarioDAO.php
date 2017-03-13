<?php

require_once './banco/Banco.php';
require_once './modelo/Usuario.php';

class UsuarioDAO {

    private $banco;

    function __construct() {
        $this->banco = new Banco();
    }

    function __destruct() {
        $this->banco->Disconnect();
    }

    public function cadastra(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuarios (nome_usuario, login_usuario, senha_usuario, cidade_usuario)"
                    . " VALUES (:nome, :login, :senha, :cidade)";

            $parametros = array(
                ":nome" => $usuario->getNome_usuario(),
                ":login" => $usuario->getLogin_usuario(),
                ":senha" => $usuario->getSenha_usuario(),
                ":cidade" => $usuario->getCidade_usuario()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function lista($inicio, $fim) {
        try {
            $sql = "SELECT cod_usuario, nome_usuario, login_usuario FROM usuarios LIMIT :inicio, :fim";

            $usuarios = [];
            
            $parametros = array (
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            
            $retorno = $this->banco->ExecuteQuery($sql, $parametros);

            foreach ($retorno as $ln) {
                $usuario = new Usuario();
                $usuario->setCod_usuario($ln['cod_usuario']);
                $usuario->setNome_usuario($ln['nome_usuario']);
                $usuario->setLogin_usuario($ln['login_usuario']);

                $usuarios[] = $usuario;
            }

            return $usuarios;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar(Usuario $usuario) {

        try {
            $sql = "UPDATE usuarios SET"
                    . " nome_usuario = :nome, login_usuario = :login, senha_usuario = :senha, cidade_usuario = :cidade"
                    . " WHERE"
                    . " cod_usuario = :cod";
            $parametros = array(
                ":nome" => $usuario->getNome_usuario(),
                ":login" => $usuario->getLogin_usuario(),
                ":senha" => $usuario->getSenha_usuario(),
                ":cidade" => $usuario->getCidade_usuario(),
                ":cod" => $usuario->getCod_usuario()
            );

            return $this->banco->ExecuteNonQuery($sql, $parametros);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function busca($cod) {
        try {
            $sql = "SELECT cod_usuario, nome_usuario, login_usuario FROM usuarios WHERE cod_usuario = :cod";

            $parametros = array(
                ":cod" => $cod
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $usuario = new Usuario();
            $usuario->setCod_usuario($retorno['cod_usuario']);
            $usuario->setNome_usuario($retorno['nome_usuario']);
            $usuario->setLogin_usuario($retorno['login_usuario']);

            return $usuario;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function buscaAutentica($login, $senha) {
        try {
            $sql = "SELECT cod_usuario, nome_usuario, login_usuario, cidade_usuario FROM usuarios"
                    . " WHERE nome_usuario LIKE :login AND senha_usuario LIKE :senha";

            $parametros = array(
                ":login" => $login,
                ":senha" => $senha
            );

            $retorno = $this->banco->ExecuteQueryOneRow($sql, $parametros);

            $usuario = new Usuario();
            $usuario->setCod_usuario($retorno['cod_usuario']);
            $usuario->setNome_usuario($retorno['nome_usuario']);
            $usuario->setLogin_usuario($retorno['login_usuario']);
            $usuario->setCidade_usuario($retorno['cidade_usuario']);

            return $usuario;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function excluir($cod) {
        try {
            $sql = "DELETE FROM usuarios WHERE cod_usuario = :cod";

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
