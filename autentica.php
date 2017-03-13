<?php

$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', dirname(__FILE__) . DS);

require_once BASE_DIR . 'banco' . DS . 'Banco.php';
require_once BASE_DIR . 'modelo' . DS . 'Usuario.php';
require_once BASE_DIR . 'controle' . DS . 'UsuarioControle.php';

$usuarioControle = new UsuarioControle();

session_start();

$login = filter_input(INPUT_POST, "user");
$senha = filter_input(INPUT_POST, "pass");

$usuario = $usuarioControle->buscaAutentica($login, $senha);

if ($usuario->getNome_usuario() != null) {
    echo $usuario->getNome_usuario();
    echo $usuario->getCidade_usuario();
    $_SESSION["login"] = $usuario->getNome_usuario();
    $_SESSION["cidade"] = $usuario->getCidade_usuario();
    
    $extra = 'controle.php';
    header("Location: http://$host$uri/$extra");
} else {
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
}