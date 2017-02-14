<?php
define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', (dirname(__FILE__)) . DS);

include_once BASE_DIR . 'dao' . DS . 'ClienteDAO.php';
include_once BASE_DIR . 'modelo' . DS . 'Cliente.php';

$daoCliente = new ClienteDAO();

$consulta = filter_input(INPUT_GET, "term");

echo json_encode($daoCliente->buscaDinamica($consulta));