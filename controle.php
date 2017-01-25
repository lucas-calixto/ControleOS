<?php ?>
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
                                    <li><a href="#">Cadastro de Usuários</a></li>
                                    <li><a href="#">Cadastro de Atendentes</a></li>
                                    <li><a href="#">Cadastro de Tecnicos</a></li>
                                    <li><a href="#">Cadastro de Tipos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Cadastro de Clientes</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Controle</a></li>
                            <li><a href="#">Atendimentos</a></li>
                            <li><a href="#">Relatorios</a></li>
                            <li><a href="#">Logs</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" title="Sair"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Inicio da parte dinâmica-->
        <section class="container">
            <article class="col-lg-9">
                <div class="well">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Cadastro de Usuários</legend>
                            <div class="form-group">
                                <label for="nome_usuario" class="col-lg-2 control-label">Nome:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="nome_usuario" placeholder="Nome do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login_usuario" class="col-lg-2 control-label">Login:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="login_usuario" placeholder="Login para acesso do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha_usuario" class="col-lg-2 control-label">Senha:</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="senha_usuario" placeholder="Senha para acesso do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha_dois_usuario" class="col-lg-2 control-label">Repetir senha:</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="senha_dois_usuario" placeholder="Repita a mesma senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary">Gravar</button>
                                    <button type="reset" class="btn btn-default">Limpar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="esp-tabela">1</span></td>
                            <td><span class="esp-tabela">João da Silva</span></td>
                            <td><span class="esp-tabela">joao</span></td>
                            <td><a href="#" class="btn btn-warning btn-xs">Editar</a>
                                <a href="#" class="btn btn-danger btn-xs">Excluir</a></td>
                        </tr>
                    </tbody>
                </table> 
            </article>

            <article class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajuda</div>
                    <div class="panel-body">
                        <p>Esta e uma tela de ajuda e recomendações do sistema.</p>
                    </div>
                </div>
            </article>
        </section>

        <div class="container">
            <footer class="col-lg-12">
                <ul class="breadcrumb">
                    <li  class="active">Direitos Reservados a Tec Port Informatica - Porteirinha MG</li>
                </ul>
            </footer>
        </div>
        <!-- Inicio da parte dinâmica-->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>