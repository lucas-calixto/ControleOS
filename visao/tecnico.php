<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './controle/TecnicoControle.php';
require_once './modelo/Tecnico.php';

$controle = new TecnicoControle();
$tecnico = new Tecnico();

$nome_tecnico = "";

$acao = filter_input(INPUT_GET, 'acao');
$cod_tecnico = filter_input(INPUT_GET, 'cod_tecnico');

if (!$acao) {
    $tecnico->setNome_tecnico(filter_input(INPUT_POST, 'nome_tecnico'));

    if ($controle->cadastra($tecnico)) {
        $resultado = "Tecnico cadastrado com sucesso!";
    } else {
        $resultado = "Erro ao cadastrado tecnico!";
    }
} elseif (!strcmp($acao, 'editar')) {
    $tecnico = $controle->busca($cod_tecnico);
    $nome_tecnico = $tecnico->getNome_tecnico();
} elseif (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    $tecnico->setCod_tecnico($cod_tecnico);
    $tecnico->setNome_tecnico(filter_input(INPUT_POST, 'nome_tecnico'));
    if ($controle->editar($tecnico)) {
        $resultado = "Tecnico editado com sucesso!";
        $extra = 'controle.php?pg=tecnico';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao editado tecnico!";
    }
} else {
    $controle->excluir($cod_tecnico);
    $resultado = "Tecnico excluido com sucesso!";
    $extra = 'controle.php?pg=tecnico';
    header("Location: http://$host$uri/$extra");
}
?>

<section class="container">
    <article class="col-lg-9">
        <div class="well">
            <form class="form-horizontal" method="POST" action="?pg=tecnico<?php
            if ($acao) {
                echo '&acao=ir&metodo=gravar&cod_tecnico=';
                echo filter_input(INPUT_GET, "cod_tecnico");
            }
            ?>" id="form">
                <fieldset>
                    <?php if ($acao) { ?>
                        <legend>Editar Tecnico</legend>
                    <?php } else { ?>
                        <legend>Cadastro de Tecnicos</legend>
                    <?php } ?>
                    <div class="form-group">
                        <label for="nome_tecnico" class="col-lg-2 control-label">Nome:</label>
                        <div class="col-lg-10">
                            <input type="text" name="nome_tecnico" value="<?= $nome_tecnico ?>" class="form-control" id="nome_tecnico" placeholder="Nome do tecnico" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <?php if (!strcmp($acao, "gravar")) { ?>
                                <input type="hidden" value="gravar" />
                            <?php } ?>
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
                    <th class="col-lg-10">Nome</th>
                    <th class="col-lg-1"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($controle->lista() as $tecnico) { ?>
                    <tr>
                        <td><span class="esp-tabela"><?= $tecnico->getCod_tecnico() ?></span></td>
                        <td><span class="esp-tabela"><?= $tecnico->getNome_tecnico() ?></span></td>
                        <td><a href="?pg=tecnico&acao=editar&cod_tecnico=<?= $tecnico->getCod_tecnico() ?>" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                            <a href="?pg=tecnico&acao=excluir&cod_tecnico=<?= $tecnico->getCod_tecnico() ?>" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
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