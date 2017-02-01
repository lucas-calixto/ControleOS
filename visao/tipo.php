<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './controle/TipoControle.php';
require_once './modelo/Tipo.php';

$controle = new TipoControle();
$tipo = new Tipo();

$desc_tipo = "";

$acao = filter_input(INPUT_GET, 'acao');
$cod_tipo = filter_input(INPUT_GET, 'cod_tipo');

if (!$acao) {
    $tipo->setDesc_tipo(filter_input(INPUT_POST, 'desc_tipo'));

    if ($controle->cadastra($tipo)) {
        $resultado = "Tipo cadastrado com sucesso!";
    } else {
        $resultado = "Erro ao cadastrado Tipo!";
    }
} elseif (!strcmp($acao, 'editar')) {
    $tipo = $controle->busca($cod_tipo);
    $desc_tipo = $tipo->getDesc_tipo();
} elseif (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    $tipo->setCod_tipo($cod_tipo);
    $tipo->setDesc_tipo(filter_input(INPUT_POST, 'desc_tipo'));
    if ($controle->editar($tipo)) {
        $resultado = "Tipo editado com sucesso!";
        $extra = 'controle.php?pg=tipo';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao editar tipo!";
    }
} else {
    $controle->excluir($cod_tipo);
    $resultado = "Tipo excluido com sucesso!";
    $extra = 'controle.php?pg=tipo';
    header("Location: http://$host$uri/$extra");
}
?>

<section class="container">
    <article class="col-lg-9">
        <div class="well">
            <form class="form-horizontal" method="POST" action="?pg=tipo<?php
            if ($acao) {
                echo '&acao=ir&metodo=gravar&cod_tipo=';
                echo filter_input(INPUT_GET, "cod_tipo");
            }
            ?>" id="form">
                <fieldset>
                    <?php if ($acao) { ?>
                        <legend>Editar Tipo</legend>
                    <?php } else { ?>
                        <legend>Cadastro de Tipos</legend>
                    <?php } ?>
                    <div class="form-group">
                        <label for="desc_tipo" class="col-lg-2 control-label">Descrição:</label>
                        <div class="col-lg-10">
                            <input type="text" name="desc_tipo" value="<?= $desc_tipo ?>" class="form-control" id="desc_tipo" placeholder="Descrição do tipo" required="" />
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
                <?php
                $qtd = count($controle->lista(0, 1000));
                $qtd_reg = 5;
                $qtd_pag = ceil($qtd / $qtd_reg);
                $pag_atual = filter_input(INPUT_GET, 'pag');

                if (empty($pag_atual)) {
                    $inicio = 0;
                    $fim = $qtd_reg;
                } else {
                    $pag = filter_input(INPUT_GET, 'pag');

                    $inicio = ($qtd_reg * $pag) - $qtd_reg;
                    $fim = $qtd_reg;
                }

                foreach ($controle->lista($inicio, $fim) as $tipo) {
                    ?>
                    <tr>
                        <td><span class="esp-tabela"><?= $tipo->getCod_tipo() ?></span></td>
                        <td><span class="esp-tabela"><?= $tipo->getDesc_tipo() ?></span></td>
                        <td><a href="?pg=tipo&acao=editar&cod_tipo=<?= $tipo->getCod_tipo() ?>" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                            <a href="?pg=tipo&acao=excluir&cod_tipo=<?= $tipo->getCod_tipo() ?>" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php for ($ln = 0; $ln < $qtd_pag; $ln++) { ?>
                    <a href="?pg=tipo&pag=<?= $ln + 1 ?>" class="btn btn-xs btn-primary"><?= $ln + 1 ?></a>
                <?php } ?>
            </div>
        </div>
        <br />
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