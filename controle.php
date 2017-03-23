<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

session_start();

$login = $_SESSION["login"];

if ($login ==  null) {
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controle de O.S.</title>

        <!-- Bootstrap -->
        <link href="https://bootswatch.com/flatly/bootstrap.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <link href="css/jquery-editable-select.min.css" rel="stylesheet">
        <link href="css/jquery-ui-1.10.0.custom.css" rel="stylesheet">

        <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="col-lg-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="?pg=controleos"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Tec Port</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Arquivo <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="divider"></li>
                                    <li><a href="?pg=usuario"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Cadastro de Usuários</a></li>
                                    <!--<li><a href="?pg=atendente">Cadastro de Atendentes</a></li>-->
                                    <li><a href="?pg=tecnico"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Cadastro de Tecnicos</a></li>
                                    <li><a href="?pg=tipo"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Cadastro de Tipos</a></li>
                                </ul>
                            </li>
                            <li><a href="?pg=controleos">Controle</a></li>
                            <li><a href="?pg=atendimento">Atendimentos</a></li>
                            <li><a href="?pg=relatorios">Relatorios</a></li>
                            <!--<li><a href="?pg=log">Logs</a></li>-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="logout.php" title="Sair"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Inicio da parte dinâmica-->
        <?php
        define('DS', DIRECTORY_SEPARATOR);
        define('BASE_DIR', dirname(__FILE__) . DS);

        $pg = filter_input(INPUT_GET, "pg");

        switch ($pg) {
            case "usuario":
                require_once './visao/usuario.php';
                break;
            case "atendente":
                require_once './visao/atendente.php';
                break;
            case "tecnico":
                require './visao/tecnico.php';
                break;
            case "tipo":
                require_once './visao/tipo.php';
                break;
            case "controleos":
                require_once './visao/controleos.php';
                break;
            case "novaos":
                require_once './visao/novaos.php';
                break;
            case "imprimiros":
                require_once './visao/imprimiros.php';
                break;
            case "atendimento":
                require_once './visao/atendimento.php';
                break;
            case "relatorios":
                require_once './visao/relatorios.php';
                break;
            default:
                require_once './visao/controleos.php';
        }
        ?>
        <!-- Inicio da parte dinâmica-->

        <div class="container">
            <footer class="col-lg-12">
                <ul class="breadcrumb">
                    <li  class="active">&copy; Direitos Reservados a Tec Port Informatica, Porteirinha MG - <b>v 1.0_Beta-Rev-1</b></li>
                </ul>
            </footer>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script>
            $(function () {
                $("#busca_cliente").autocomplete({
                    source: 'searchc.php'
                });
            });

            function preencheEditar(valor, txtOrdem, codTecnico) {
                document.getElementById('cod_ordem').value = valor;
                document.getElementById('txt_desc_ordem').value = txtOrdem;

                var combo = document.getElementById("cod_tecnico");

                for (var i = 0; i < combo.options.length; i++) {
                    if (combo.options[i].value == codTecnico) {
                        combo.options[i].selected = "true";
                        break;
                    }
                }
            }

            function preencheBaixar(valor) {
                document.getElementById('cod_ordem_baixar').value = valor;
            }
        </script>
    </body>
</html>