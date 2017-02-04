<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');
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
    $controle->excluir($cod_atendente);
    $resultado = "Atendente editado com sucesso!";
    $extra = 'controle.php?pg=atendente';
    header("Location: http://$host$uri/$extra");
}
?>
<section class="container">
    <article class="col-lg-12">
        <h2>Controle de Ordens de Serviços</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    
                </div>
            </div>
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
</section>