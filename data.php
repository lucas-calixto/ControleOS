<?php

$data_inicio = filter_input(INPUT_POST, 'data_inicio');
$data_fim = filter_input(INPUT_POST, 'data_fim');

echo date('Y-m-d', strtotime($data_inicio));
echo '<br />';
echo date('H:i:s', strtotime($data_inicio));
echo '<br />';
echo '<br />';

echo date('Y-m-d', strtotime($data_fim));
echo '<br />';
echo date('H:i:s', strtotime($data_fim));
echo '<br />';