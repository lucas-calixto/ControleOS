<?php

//ibase_connect — Abre uma conexão com um banco de dados InterBase
//pode ser colocado o IP, ou nome do computador onde esta o banco de dados
 
$servidor = 'localhost:C:/InterNews/Banco de dados/TECPORT.FDB';
 
//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($servidor, 'SYSDBA', 'masterkey'))) {
    die('Erro ao conectar: ' .  ibase_errmsg());
}