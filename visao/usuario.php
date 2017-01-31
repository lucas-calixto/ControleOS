<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');
require_once './controle/UsuarioControle.php';
require_once './modelo/Usuario.php';
$controle = new UsuarioControle();
$usuario = new Usuario();

$nome_usuario = "";
$login_usuario = "";
$senha_usuario = "";

$acao = filter_input(INPUT_GET, "acao");
$cod_usuario = filter_input(INPUT_GET, "cod_usuario");

if (!$acao) {
    $usuario->setNome_usuario(filter_input(INPUT_POST, "nome_usuario"));
    $usuario->setLogin_usuario(filter_input(INPUT_POST, "login_usuario"));
    $usuario->setSenha_usuario(filter_input(INPUT_POST, "senha_usuario"));

    if ($controle->cadastra($usuario)) {
        $resultado = "Usuário cadastrado com sucesso!";
    } else {
        $resultado = "Erro ao cadastrar usuário!";
    }
} elseif (!strcmp($acao, "editar")) {
    $usuario = $controle->busca($cod_usuario);
    $nome_usuario = $usuario->getNome_usuario();
    $login_usuario = $usuario->getLogin_usuario();
} elseif (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    $usuario->setCod_usuario($cod_usuario);
    $usuario->setNome_usuario(filter_input(INPUT_POST, "nome_usuario"));
    $usuario->setLogin_usuario(filter_input(INPUT_POST, "login_usuario"));
    $usuario->setSenha_usuario(filter_input(INPUT_POST, "senha_usuario"));
    if ($controle->editar($usuario)) {
        $resultado = "Usuário editado com sucesso!";
        $extra = 'controle.php?pg=usuario';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao cadastrar usuário!";
    }
} else {
    $controle->excluir($cod_usuario);
    $resultado = "Usuário editado com sucesso!";
    $extra = 'controle.php?pg=usuario';
    header("Location: http://$host$uri/$extra");
}
?>
<!-- SCRIPT DE VALIDAÇÃO DOS CAMPOS DE SENHA -->
<script>
    function validaSenha() {
        senha = document.getElementById("senha_usuario").value;
        senhaDois = document.getElementById("senha_dois_usuario").value;

        if (senha !== senhaDois) {
            alert("As senhas não conferem!");
        } else if (senha === '') {
            alert("Digite uma senha!");
        } else {
            document.getElementById("form").submit();
        }
    }
</script>

<section class="container">
    <article class="col-lg-9">
        <div class="well">
            <form class="form-horizontal" method="POST" action="?pg=usuario<?php
            if ($acao) {
                echo '&acao=ir&metodo=gravar&cod_usuario=';
                echo filter_input(INPUT_GET, "cod_usuario");
            }
            ?>" id="form">
                <fieldset>
                    <?php if ($acao) { ?>
                        <legend>Editar Usuário</legend>
                    <?php } else { ?>
                        <legend>Cadastro de Usuários</legend>
                    <?php } ?>

                    <div class="form-group">
                        <label for="nome_usuario" class="col-lg-2 control-label">Nome:</label>
                        <div class="col-lg-10">
                            <input type="text" name="nome_usuario" class="form-control" id="nome_usuario" value="<?= $nome_usuario ?>" placeholder="Nome do usuário" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login_usuario" class="col-lg-2 control-label">Login:</label>
                        <div class="col-lg-10">
                            <input type="text" name="login_usuario" class="form-control" id="login_usuario" value="<?= $login_usuario ?>" placeholder="Login para acesso do usuário" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha_usuario" class="col-lg-2 control-label">Senha:</label>
                        <div class="col-lg-10">
                            <input type="password" name="senha_usuario" class="form-control" id="senha_usuario" value="<?= $senha_usuario ?>" placeholder="Senha para acesso do usuário" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha_dois_usuario" class="col-lg-2 control-label">Repetir senha:</label>
                        <div class="col-lg-10">
                            <input type="password" name="senha_dois_usuario" class="form-control" id="senha_dois_usuario" value="" placeholder="Repita a mesma senha" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <?php if (!strcmp($acao, "gravar")) { ?>
                                <input type="hidden" value="gravar" />
                            <?php } ?>

                            <button type="button" class="btn btn-success" onclick="validaSenha()">Gravar</button>
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
                <?php foreach ($controle->lista() as $usuario) { ?>
                    <tr>
                        <td><span class="esp-tabela"><?= $usuario->getCod_usuario(); ?></span></td>
                        <td><span class="esp-tabela"><?= $usuario->getNome_usuario(); ?></span></td>
                        <td><span class="esp-tabela"><?= $usuario->getLogin_usuario(); ?></span></td>
                        <td><a href="?pg=usuario&cod_usuario=<?= $usuario->getCod_usuario(); ?>&acao=editar" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                            <a href="?pg=usuario&cod_usuario=<?= $usuario->getCod_usuario(); ?>&acao=excluir" title="Exclir" onclick="return confirm('Deseja excluir este registro?')"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
                    </tr>
                <?php } ?>
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