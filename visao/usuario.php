<?php
require_once './controle/UsuarioControle.php';
require_once './modelo/Usuario.php';
$controle = new UsuarioControle();
$usuario = new Usuario();

$nome_usuario = "";
$login_usuario = "";
$senha_usuario = "";
$senha_dois_usuario = "";

$cod_usuario = filter_input(INPUT_POST, "cod_usuario");

if ($cod_usuario) {
    $usuario->setNome_usuario(filter_input(INPUT_POST, "nome_usuario"));
    $usuario->setLogin_usuario(filter_input(INPUT_POST, "login_usuario"));
    $usuario->setSenha_usuario(filter_input(INPUT_POST, "senha_usuario"));
    
    if ($controle->cadastra($usuario)) {
        $resultado = "Usuário cadastrado com sucesso!";
    } else {
        $resultado = "Erro ao cadastrar usuário!";
    }
} else {
    
}
?>

        <section class="container">
            <article class="col-lg-9">
                <div class="well">
                    <form class="form-horizontal" method="POST" action="?pg=usuario">
                        <fieldset>
                            <legend>Cadastro de Usuários</legend>
                            <div class="form-group">
                                <label for="nome_usuario" class="col-lg-2 control-label">Nome:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="nome_usuario" value="<?= $nome_usuario ?>" placeholder="Nome do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login_usuario" class="col-lg-2 control-label">Login:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="login_usuario" value="<?= $login_usuario ?>" placeholder="Login para acesso do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha_usuario" class="col-lg-2 control-label">Senha:</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="senha_usuario" value="<?= $senha_usuario ?>" placeholder="Senha para acesso do usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha_dois_usuario" class="col-lg-2 control-label">Repetir senha:</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="senha_dois_usuario" value="<?= $senha_dois_usuario ?>" placeholder="Repita a mesma senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-success">Gravar</button>
                                    <button type="reset" class="btn btn-default">Limpar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="col-lg-1">Codigo</th>
                            <th class="col-lg-7">Nome</th>
                            <th class="col-lg-3">Usuário</th>
                            <th class="col-lg-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="esp-tabela">1</span></td>
                            <td><span class="esp-tabela">João da Silva</span></td>
                            <td><span class="esp-tabela">joao</span></td>
                            <td><a href="#" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                                <a href="#" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
                        </tr>
                        <tr>
                            <td><span class="esp-tabela">2</span></td>
                            <td><span class="esp-tabela">Paulo Silveira</span></td>
                            <td><span class="esp-tabela">paulo</span></td>
                            <td><a href="#" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                                <a href="#" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
                        </tr>
                        <tr>
                            <td><span class="esp-tabela">1</span></td>
                            <td><span class="esp-tabela">Maria Joana</span></td>
                            <td><span class="esp-tabela">maria</span></td>
                            <td><a href="#" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                                <a href="#" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
                        </tr>
                    </tbody>
                </table> 
            </article>

            <article class="col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Ajuda</div>
                    <div class="panel-body">
                        <p>Esta e uma tela de ajuda e recomendações do sistema.</p>
                    </div>
                </div>
            </article>
        </section>
