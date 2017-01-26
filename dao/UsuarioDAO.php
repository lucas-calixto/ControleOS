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
            $sql = "INSERT INTO (nome_usuario, login_usuario, senha_usuario) VALUES (:usuario :nome :senha);";

            $parametros = array(
                ":usuario" => $usuario->getNome_usuario(),
                ":login" => $usuario->getLogin_usuario(),
                ":senha" => $usuario->getSenha_usuario()
            );
            
            return $this->banco->ExecuteNonQuery($sql, $parametros);
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
