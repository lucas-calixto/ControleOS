<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './controle/OrdemControle.php';
require_once './modelo/Ordem.php';
require_once './modelo/Cliente.php';

$controle = new OrdemControle();
$ordem = new Ordem();

$acao = filter_input(INPUT_GET, "acao");
$cod_ordem = filter_input(INPUT_GET, "cod_atendente");

if (!$acao) {
    
} elseif (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    
} else {
    $controle->excluir($cod_ordem);
    $resultado = "Ordem excluido com sucesso!";
    $extra = 'controle.php?pg=controleos';
    header("Location: http://$host$uri/$extra");
}
?>
<section class="container">
    <article class="col-lg-12">
        <h2>CONTROLE DE O.S.</h2>
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
                    <th class="col-lg-3">Cliente</th>
                    <th class="col-lg-4">Descrição</th>
                    <th class="col-lg-2">Data de Cadastro</th>
                    <th class="col-lg-1">Status</th>
                    <th class="col-lg-1 text-center">Ações</th>
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

                foreach ($controle->lista($inicio, $fim) as $ordem) {
                    ?>
                    <tr>
                        <td><?= $ordem->getCod_ordem() ?></td>
                        <td><?php
                            $cliente = $ordem->getCod_cliente_ordem();
                            echo $cliente->getNome_cliente();
                            ?></td>
                        <td><?= $ordem->getDesc_ordem() ?></td>
                        <td><?= date('d/m/Y', strtotime($ordem->getData_cad_ordem())) ?></td>
                        <td><?= $ordem->getStatus_ordem() ?></td>
                        <td class="text-right">
                            <a href="" title="Baixar"><span class="glyphicon glyphicon-ok-circle blue" aria-hidden="true"></span></a>
                            <a href="" title="Editar"><span class="glyphicon glyphicon-circle-arrow-up orange" aria-hidden="true"></span></a>
                            <a href="" title="Exclir"><span class="glyphicon glyphicon-remove-circle red" aria-hidden="true"></span></a>
                            <a href="" title="Imprimir"><span class="glyphicon glyphicon-info-sign green" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </article>
    <div class="col-lg-12">
        <div class="btn-toolbar">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#selectCliente">NOVO</button>
            <div class="btn-group">
                <?php for ($ln = 0; $ln < $qtd_pag; $ln++) { ?>
                    <a href="?pg=controleos&pag=<?= $ln + 1 ?>" class="btn btn-sm btn-primary"><?= $ln + 1 ?></a>
                <?php } ?>
                <a href="?pg=controleos&pag=<?= $qtd_pag ?>" class="btn btn-sm btn-primary">>></a>
            </div>
        </div>
        <br />
    </div>

    <div class="modal fade" id="selectCliente"><!-- INICIO DO MODAL DE NOVO -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Selecionar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form action="?pg=novaos" method="POST">
                        <select class="form-control" id="select">
                            <?php
                            foreach ($controle->lista(0, 1000) as $ordem) {
                            $cliente = $ordem->getCod_cliente_ordem();
                            ?>
                            <option><?= $cliente->getNome_cliente() ?></option>
                            <?php } ?>
                        </select>
                        <br />
                        <input type="submit" value="Selecionar" class="btn btn-success btn-sm btn-block"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div><!-- FIM DO MODAL DE NOVO -->
</section>