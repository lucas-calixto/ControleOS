<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controle de O.S.</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="col-lg-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Controle de O.S.</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Arquivo <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="divider"></li>
                                    <li><a href="?pg=usuario">Cadastro de Usuários</a></li>
                                    <li><a href="?pg=atendente">Cadastro de Atendentes</a></li>
                                    <li><a href="?pg=tecnico">Cadastro de Tecnicos</a></li>
                                    <li><a href="?pg=tipo">Cadastro de Tipos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="?pg=cliente">Cadastro de Clientes</a></li>
                                </ul>
                            </li>
                            <li><a href="?pg=controle">Controle</a></li>
                            <li><a href="?pg=atendimento">Atendimentos</a></li>
                            <li><a href="?pg=relatorio">Relatorios</a></li>
                            <li><a href="?pg=log">Logs</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" title="Sair"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Inicio da parte dinâmica-->
        <?php
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
            default:
                require_once './visao/usuario.php';
        }
        ?>
        <!-- Inicio da parte dinâmica-->

        <div class="container">
            <footer class="col-lg-12">
                <ul class="breadcrumb">
                    <li  class="active">&copy; Direitos Reservados a Tec Port Informatica, Porteirinha MG - <b>v 1.0-Beta</b></li>
                </ul>
            </footer>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>