<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './modelo/Ordem.php';
require_once './dao/ClienteDAO.php';
require_once './dao/CidadeDAO.php';
require_once './modelo/Cliente.php';
require_once './controle/OrdemControle.php';
require_once './controle/TipoControle.php';
require_once './controle/TecnicoControle.php';

$ordem = new Ordem();
$dao = new ClienteDAO();
$controle = new OrdemControle();
$daoTecnico = new TecnicoControle();
$cidadeDao = new CidadeDAO();
$tipoControle = new TipoControle();

if (!strcmp(filter_input(INPUT_GET, "acao"), "editar")) {

    $ordem->setCod_ordem(filter_input(INPUT_POST, "cod_ordem"));
    $ordem->setDesc_total_ordem(filter_input(INPUT_POST, "desc_total_ordem"));
    $ordem->setCod_tecnico_ordem(filter_input(INPUT_POST, "cod_tecnico"));
    $ordem->setStatus_ordem(filter_input(INPUT_POST, "radioStatus"));

    if ($controle->editar($ordem)) {
        $extra = 'controle.php?pg=controleos';
        header("Location: http://$host$uri/$extra");
    }
} elseif (!strcmp(filter_input(INPUT_GET, "acao"), "excluir")) {
    if ($controle->excluir(filter_input(INPUT_GET, "cod_ordem"))) {
        $resultado = "Ordem excluido com sucesso!";
        $extra = 'controle.php?pg=controleos';
        header("Location: http://$host$uri/$extra");
    }
} elseif (!strcmp(filter_input(INPUT_GET, "acao"), "baixar")) {

    $ordem->setCod_ordem(filter_input(INPUT_POST, "cod_ordem_baixar"));
    $ordem->setDesc_resolve_ordem(filter_input(INPUT_POST, "desc_resolve_ordem"));

    $ordem->setData_inicio_ordem(date('Y-m-d', strtotime(filter_input(INPUT_POST, 'data_inicio'))));
    $ordem->setData_fim_ordem(date('Y-m-d', strtotime(filter_input(INPUT_POST, 'data_fim'))));
    $ordem->setHora_inicio_ordem(date('H:i:s', strtotime(filter_input(INPUT_POST, 'data_inicio'))));
    $ordem->setHora_fim_ordem(date('H:i:s', strtotime(filter_input(INPUT_POST, 'data_fim'))));



    if ($controle->baixar($ordem)) {
        $resultado = "Ordem baixado com sucesso!";
        $extra = 'controle.php?pg=controleos';
        header("Location: http://$host$uri/$extra");
    }
}
?>
<section class="container">
    <article class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">CONTROLE DE O.S.</div>
            <div class="panel-body">
                <div class="row">
                    <br />
                    <div class="col-lg-4">
                        <form action="?pg=controleos" method="GET" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="busca_cliente">Cliente</label>  
                                <div class="col-md-8">
                                    <input id="busca_cliente" name="busca_cliente" type="text" placeholder="Nome do cliente" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-4">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=controleos" class="btn btn-xs btn-primary">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <form action="?pg=controleos" method="GET" class="form-horizontal">
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="cidade_cliente">Cidade</label>
                                <div class="col-md-8">
                                    <select id="cidade_cliente" name="cidade_cliente" class="form-control">
                                        <?php foreach ($cidadeDao->listar() as $ln) { ?>
                                            <option value="<?= $ln->getCod_cidade() ?>"><?= $ln->getDesc_cidade() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-4">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=controleos" class="btn btn-xs btn-primary">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <form action="?pg=controleos" method="GET" class="form-horizontal">
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tipo_ordem">Tipo</label>
                                <div class="col-md-8">
                                    <select id="tipo_ordem" name="tipo_ordem" class="form-control">
                                        <?php foreach ($tipoControle->lista(0, 100) as $lnTipo) { ?>
                                            <option value="<?= $lnTipo->getCod_tipo() ?>"><?= $lnTipo->getDesc_tipo() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-4">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=controleos" class="btn btn-xs btn-primary">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th class="col-lg-1">Codigo</th>
                    <th class="col-lg-3">Cliente</th>
                    <th class="col-lg-3">Descrição</th>
                    <th class="col-lg-2">Data de Cadastro</th>
                    <th class="col-lg-2">Tipo</th>
                    <th class="col-lg-1 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qtd = count($controle->lista(0, 1000));
                $qtd_reg = 10;
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

                $nome_cliente = "";
                $cidade_cliente = "";
                $tipo_ordem = "";

                if (!empty(filter_input(INPUT_GET, "busca_cliente"))) {
                    $nome_cliente = filter_input(INPUT_GET, "busca_cliente");
                }

                if (!empty(filter_input(INPUT_GET, "cidade_cliente"))) {
                    $cidade_cliente = filter_input(INPUT_GET, "cidade_cliente");
                }

                if (!empty(filter_input(INPUT_GET, "tipo_ordem"))) {
                    $tipo_ordem = filter_input(INPUT_GET, "tipo_ordem");
                }

                foreach ($controle->lista($inicio, $fim, $nome_cliente, $cidade_cliente, $tipo_ordem) as $ordem) {
                    ?>
                    <tr>
                        <td><?= $ordem->getCod_ordem() ?></td>
                        <td><?php
                            $cliente = $ordem->getCod_cliente_ordem();
                            echo $cliente->getNome_cliente();
                            ?></td>
                        <td><?= $ordem->getDesc_ordem() ?></td>
                        <td><?= date('d/m/Y', strtotime($ordem->getData_cad_ordem())) . ' - ' . date('H:i', strtotime($ordem->getHora_cad_ordem())) ?></td>
                        <td><?= $ordem->getCod_tipo_ordem()->getDesc_tipo() ?></td>
                        <td class="text-right">
                            <a href="" title="Baixar" data-toggle="modal" data-target="#baixaOrdem" onclick="preencheBaixar(<?= $ordem->getCod_ordem() ?>)"><span class="glyphicon glyphicon-ok-circle blue" aria-hidden="true"></span></a>
                            <a href="" title="Editar" data-toggle="modal" data-target="#editarOrdem" onclick="preencheEditar(<?= $ordem->getCod_ordem() ?>, '<?= $ordem->getDesc_total_ordem() ?>', <?= $ordem->getCod_tecnico_ordem() ?>)"><span class="glyphicon glyphicon-refresh orange" aria-hidden="true"></span></a>
                            <a href="?pg=controleos&acao=excluir&cod_ordem=<?= $ordem->getCod_ordem() ?>" title="Exclir" onclick="return confirm('Deseja excluir este registro?')"><span class="glyphicon glyphicon-remove-circle red" aria-hidden="true"></span></a>
                            <a href="visao/imprimiros.php?cod_ordem=<?= $ordem->getCod_ordem() ?>" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-info-sign green" aria-hidden="true"></span></a>
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
            </div>
        </div>
        <br />
    </div>

    <!-- INICIO DO MODAL DE NOVO -->
    <div class="modal fade" id="selectCliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                    <h4 class="modal-title">Selecionar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form action="controle.php?pg=novaos" method="POST">
                        <div class="ui-widget">
                            <select class="form-control" name="cod_cliente" id="combobox" required="">
                                <option value="">Selecione</option>
                                <?php foreach ($dao->lista() as $cliente) { ?>
                                <option value="<?= $cliente->getCod_cliente() ?>"><?= $cliente->getCod_pers_cliente() ?> - <?= $cliente->getNome_cliente() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br />
                        <input type="submit" value="Selecionar" class="btn btn-success btn-sm btn-block"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DO MODAL DE NOVO -->

    <!-- INICIO DO MODAL DE EDITAR -->
    <div class="modal fade" id="editarOrdem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                    <h4 class="modal-title">Editar Ordem de Serviço</h4>
                </div>
                <div class="modal-body">
                    <form action="controle.php?pg=controleos&acao=editar" method="POST">
                        <textarea class="form-control" name="desc_total_ordem" rows="3" id="txt_desc_ordem"></textarea>
                        <span class="help-block">Descrição detalhada dos serviços.</span>  
                        <select id="cod_tecnico" name="cod_tecnico" class="form-control" multiple="multiple">
                            <?php foreach ($daoTecnico->lista(0, 100) as $tecnico) { ?>
                                <option value="<?= $tecnico->getCod_tecnico() ?>"><?= $tecnico->getNome_tecnico() ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block">Tecnico responsável</span>  
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" value="PENDENTE" checked=""/>
                                Em Andamento
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" value="ABERTA" />
                                Aberta
                            </label>
                        </div>
                        <br />
                        <input type="hidden" value="" name="cod_ordem" id="cod_ordem" />
                        <input type="submit" value="Gravar" class="btn btn-success btn-sm btn-block"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DO MODAL DE EDITAR -->

    <!-- INICIO DO MODAL DE BAIXAR -->
    <div class="modal fade" id="baixaOrdem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                    <h4 class="modal-title">Baixar Ordem de Serviço</h4>
                </div>
                <div class="modal-body">
                    <form action="controle.php?pg=controleos&acao=baixar" method="POST">
                        <textarea class="form-control" name="desc_resolve_ordem" rows="3" id="txt_desc_ordem"></textarea>
                        <span class="help-block">Descrição detalhada dos serviços.</span>  
                        <input type="datetime-local" class="form-control" name="data_inicio" />
                        <span class="help-block">Data e hora de inicio.</span>  
                        <input type="datetime-local" class="form-control" name="data_fim" />
                        <span class="help-block">Data e hora fim.</span>  
                        <br />
                        <input type="hidden" value="" name="cod_ordem_baixar" id="cod_ordem_baixar" />
                        <input type="submit" value="Gravar" class="btn btn-success btn-sm btn-block"  onclick="return confirm('Deseja baixar esta Ordem de Serviço?')" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DO MODAL DE BAIXAR -->

</section>