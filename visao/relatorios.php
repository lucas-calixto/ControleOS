<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');
require_once './dao/RelatorioDAO.php';

$daoRelatorio = new RelatorioDAO();
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
                            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Eficiência</button>
                            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Atendimento</button>
                        </div>
                    </article>
                </div>
            </div>
            <!-- Table -->
            <table class="table">
                <?php
                $rel = filter_input(INPUT_GET, "rel");
                
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
            </table>
        </div>
    </article>
    <div class="col-lg-12">
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php for ($ln = 0; $ln < $qtd_pag; $ln++) { ?>
                    <a href="?pg=relatorios&pag=<?= $ln + 1 ?>" class="btn btn-sm btn-primary"><?= $ln + 1 ?></a>
                <?php } ?>
            </div>
        </div>
        <br />
    </div>
</section>

<!-- INICIO DO MODAL DE BAIXAR -->
    <div class="modal fade" id="relEficiencia">
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