<?php

$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

session_start();
session_destroy();

$extra = 'index.php';
header("Location: http://$host$uri/$extra");
