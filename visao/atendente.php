<?php
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
require_once './controle/AtendenteControle.php';
require_once './modelo/Atendente.php';

$controle = new AtendenteControle();
$atendente = new Atendente();

$nome_atendente = "";

$acao = filter_input(INPUT_GET, "acao");
$cod_atendente = filter_input(INPUT_GET, "cod_atendente");

if (!$acao) {
    $atendente->setNome_atendente(filter_input(INPUT_POST, "nome_atendente"));

    if ($controle->cadastra($atendente)) {
        $resultado = "Atendente cadastrado com sucesso!";
    } else {
        $resultado = "Erro ao cadastrar atendente!";
    }
} elseif (!strcmp($acao, "editar")) {
    $atendente = $controle->busca(filter_input(INPUT_GET, "cod_atendente"));
    $nome_atendente = $atendente->getNome_atendente();
} elseif (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    $atendente->setCod_atendente($cod_atendente);
    $atendente->setNome_atendente(filter_input(INPUT_POST, "nome_atendente"));
    if ($controle->editar($atendente)) {
        $resultado = "Atendente editado com sucesso!";
        $extra = 'controle.php?pg=atendente';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao cadastrar atendente!";
    }
} else {
    if ($controle->excluir($cod_atendente)) {
        $resultado = "Atendente editado com sucesso!";
        $extra = 'controle.php?pg=atendente';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao excluir atendente!";
    }
}
?>
<section class="container">
    <article class="col-lg-9">
        <div class="well">
            <form class="form-horizontal" method="POST" action="?pg=atendente<?php
            if ($acao) {
                echo '&acao=pr&metodo=gravar&cod_atendente=';
                echo filter_input(INPUT_GET, "cod_atendente");
            }
            ?>" id="form">
                <fieldset>
                    <?php if ($acao) { ?>
                        <legend>Editar Atendente</legend>
                    <?php } else { ?>
                        <legend>Cadastro de Atendentes</legend>
                    <?php } ?>
                    <div class="form-group">
                        <label for="nome_atendente" class="col-lg-2 control-label">Nome:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="nome_atendente" name="nome_atendente" value="<?= $nome_atendente ?>" placeholder="Nome do atendente" required="">
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
                <?php foreach ($controle->lista() as $atendente) { ?>
                    <tr>
                        <td><span class="esp-tabela"><?= $atendente->getCod_atendente() ?></span></td>
                        <td><span class="esp-tabela"><?= $atendente->getNome_atendente() ?></span></td>
                        <td><a href="?pg=atendente&acao=editar&cod_atendente=<?= $atendente->getCod_atendente() ?>" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                            <a href="?pg=atendente&acao=excluir&cod_atendente=<?= $atendente->getCod_atendente() ?>" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
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