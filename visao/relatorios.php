<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');
require_once './dao/RelatorioDAO.php';
require_once './dao/ClienteDAO.php';
require_once './controle/TecnicoControle.php';

$daoRelatorio = new RelatorioDAO();
$tecnicoControle = new TecnicoControle();
$clienteDAO = new ClienteDAO();
?>

<section class="container">
    <article class="">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">TOTAL DE O.S. DO MÊS</div>
                <div class="panel-body txt-panel-dash">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?= $daoRelatorio->getTotalOSMes() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">TOTAL DE ATIVAÇÃO MÊS</div>
                <div class="panel-body txt-panel-dash">
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> <?= $daoRelatorio->getAtivacaoMes() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-danger">
                <div class="panel-heading">TOTAL DE CANCELAMENTO MÊS</div>
                <div class="panel-body txt-panel-dash">
                    <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> <?= $daoRelatorio->getCancelamentoMes() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">TEMPO MÉDIO POR O.S.</div>
                <div class="panel-body txt-panel-dash">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?= $daoRelatorio->getTempoMedioOSMes() ?> Minutos
                </div>
            </div>
        </div>
    </article>

    <div class="espaco col-lg-12"></div>
    <article class="col-lg-12">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h5>EFICIÊNCIA</h5></div>
            <div class="panel-body">
                <div class="row">
                    <article class="col-lg-4">
                        <form action="?pg=relatorios" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="busca_cliente" name="busca_cliente" type="text" placeholder="NOME DO CLIENTE" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=relatorios" class="btn btn-xs btn-primary">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </article>
                    <article class="col-lg-8">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" data-toggle="modal" data-target="#relEficiencia" class="btn btn-default"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Eficiência</button>
                            <button type="button" data-toggle="modal" data-target="#relAtendimento" class="btn btn-default"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Atendimento</button>
                        </div>
                    </article>
                </div>
            </div>
            <?php
            $rel = filter_input(INPUT_GET, "rel");
            $tpm;

            switch ($rel) {
                case "eficiencia":
                    require_once 'tbrelatorio/eficiencia.php';
                    break;
                case "atendimento":
                    require_once 'tbrelatorio/atendimento.php';
                    break;

                default:
                    require_once 'tbrelatorio/default.php';
            }
            ?>
        </div>
        <?php if (isset($tpm)) { ?>
            <div class="alert alert-success" role="alert">O tempo médio gasto pelo técnico foi de: <b> <?= $tpm ?> </b> MINUTOS</div>
        <?php } ?>
        <?php if (isset($qtd_pag)) { ?>
            <div class="btn-group col-lg-">
                <?php for ($ln = 0; $ln < $qtd_pag; $ln++) { ?>
                    <a href="?pg=relatorios&pag=<?= $ln + 1 ?>" class="btn btn-sm btn-primary"><?= $ln + 1 ?></a>
                <?php } ?>
            </div>
            <div class="col-lg-12"><br /></div>
        <?php } ?>
    </article>

</section>

<!-- INICIO DO MODAL DE EFICIENCIA -->
<div class="modal fade" id="relEficiencia">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                <h4 class="modal-title">Relatorio de Eficiência por Tecnico.</h4>
            </div>
            <div class="modal-body">
                <form action="controle.php?pg=relatorios&rel=eficiencia" method="POST">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="data_inicio">Data Inicial</label>  
                        <div class="col-md-8">
                            <input id="data_inicio" name="data_inicio" type="date" class="form-control input-md" required="">
                            <span class="help-block">Preencha a data de inicio da consulta.</span>  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="data_fim">Data Final</label>  
                        <div class="col-md-8">
                            <input id="data_fim" name="data_fim" type="date" class="form-control input-md" required="">
                            <span class="help-block">Preencha a data de fim da consulta.</span>  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="tecnico">Tecnico</label>
                        <div class="col-md-8">
                            <select id="tecnico" name="tecnico" class="form-control" multiple="multiple">
                                <?php foreach ($tecnicoControle->lista(0, 100) as $ln) { ?>
                                    <option value="<?= $ln->getCod_tecnico() ?>"><?= $ln->getNome_tecnico() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="espaco col-lg-12"></div>
                    <input type="submit" value="Buscar" class="btn btn-success btn-sm btn-block" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIM DO MODAL DE EFICIENCIA -->

<!-- INICIO DO MODAL DE ATENDIMENTO -->
<div class="modal fade" id="relAtendimento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                <h4 class="modal-title">Relatório de Atendimento por Técnico</h4>
            </div>
            <div class="modal-body">
                <form action="controle.php?pg=relatorios&rel=atendimento" method="POST">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="data_inicio">Data Inicial</label>  
                        <div class="col-md-8">
                            <input id="data_inicio" name="data_inicio" type="date" class="form-control input-md" required="">
                            <span class="help-block">Preencha a data de inicio da consulta.</span>  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="data_fim">Data Final</label>  
                        <div class="col-md-8">
                            <input id="data_fim" name="data_fim" type="date" class="form-control input-md" required="">
                            <span class="help-block">Preencha a data de fim da consulta.</span>  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="tecnico">Tecnico</label>
                        <div class="col-md-8">
                            <select id="tecnico" name="tecnico" class="form-control" multiple="multiple">
                                <?php foreach ($tecnicoControle->lista(0, 100) as $ln) { ?>
                                    <option value="<?= $ln->getCod_tecnico() ?>"><?= $ln->getNome_tecnico() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="espaco col-lg-12"></div>
                    <input type="submit" value="Buscar" class="btn btn-success btn-sm btn-block" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIM DO MODAL DE ATENDIMENTO -->