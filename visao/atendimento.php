<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './modelo/Ordem.php';
require_once './dao/ClienteDAO.php';
require_once './modelo/Cliente.php';
require_once './modelo/Atendimento.php';
require_once './controle/AtendimentoControle.php';
require_once './controle/TecnicoControle.php';

$ordem = new Ordem();
$dao = new ClienteDAO();
$controle = new AtendimentoControle();
$atendimento = new Atendimento();
$daoTecnico = new TecnicoControle();

if (!strcmp(filter_input(INPUT_GET, "acao"), "gravar")) {
    
    $ordem = new Ordem();
    $ordem->setCod_ordem(filter_input(INPUT_POST, "cod_ordem_baixar"));
    
    $atendimento->setNota_atendimento(filter_input(INPUT_POST, "nota_atendimento"));
    $atendimento->setObs_atendimento(filter_input(INPUT_POST, "obs_resolve"));
    $atendimento->setOs_resolve_atendimento(filter_input(INPUT_POST, "os_finalizada"));
    $atendimento->setOrdem_atendimento($ordem);

    if ($controle->cadastra($atendimento)) {
        $extra = 'controle.php?pg=atendimento';
        header("Location: http://$host$uri/$extra");
    }
}
?>
<section class="container">
    <article class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">ATENDIMENTO</div>
            <div class="panel-body">
                <div class="row">
                    <br />
                    <div class="col-lg-6">
                        <form action="?pg=atendimento" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="busca_cliente">Cliente</label>  
                                <div class="col-md-10">
                                    <input id="busca_cliente" name="busca_cliente" type="text" placeholder="Nome do cliente" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=atendimento" class="btn btn-xs btn-primary">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="?pg=atendimento" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="cidade_cliente">Cidade</label>
                                <div class="col-md-10">
                                    <select id="cidade_cliente" name="cidade_cliente" class="form-control">
                                        <option value="1">PORTEIRINHA</option>
                                        <option value="2">RIO PARDO DE MINAS</option>
                                        <option value="3">RIACHO DOS MACHADOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <input type="submit" value="Buscar" class="btn btn-xs btn-success" />
                                    <a href="?pg=atendimento" class="btn btn-xs btn-primary">Limpar</a>
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
                
                if(!empty(filter_input(INPUT_POST, "busca_cliente"))) {
                    $nome_cliente = filter_input(INPUT_POST, "busca_cliente");
                }
                
                if(!empty(filter_input(INPUT_POST, "cidade_cliente"))) {
                    $cidade_cliente = filter_input(INPUT_POST, "cidade_cliente");
                }

                foreach ($controle->lista($inicio, $fim, $nome_cliente, $cidade_cliente) as $ordem) {
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
                        <td class="text-center">
                            <a href="" title="Ligar" data-toggle="modal" data-target="#atendimentoOrdem" onclick="preencheBaixar(<?= $ordem->getCod_ordem() ?>)"><span class="glyphicon glyphicon-ok blue" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </article>
    <div class="col-lg-12">
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php for ($ln = 0; $ln < $qtd_pag; $ln++) { ?>
                    <a href="?pg=atendimento&pag=<?= $ln + 1 ?>" class="btn btn-sm btn-primary"><?= $ln + 1 ?></a>
                <?php } ?>
            </div>
        </div>
        <br />
    </div>

    <!-- INICIO DO MODAL DE LIGAR -->
    <div class="modal fade" id="atendimentoOrdem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload()">&times;</button>
                    <h4 class="modal-title">Atendimento</h4>
                </div>
                <div class="modal-body">
                    <form action="controle.php?pg=atendimento&acao=gravar" method="POST">
                        <select class="form-control" name="nota_atendimento" id="" required="">
                            <option value="RUIM">RUIM</option>
                            <option value="PESSIMO">PESSIMO</option>
                            <option value="BOM">BOM</option>
                            <option value="OTIMO">OTIMO</option>
                        </select>
                        <span class="help-block">Como foi o atendimento do Tecnico.</span>  
                        <br />
                        <textarea class="form-control" name="obs_resolve"></textarea>
                        <span class="help-block">Observações do cliente.</span>  
                        <br />
                        <h4>O problema foi resolvido?</h4>  
                        <div class="radio">
                            <label>
                                <input type="radio" name="os_finalizada" value="SIM" checked=""/>
                                SIM
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="os_finalizada" value="NÃO" />
                                NÃO
                            </label>
                        </div>
                        <br />
                        <input type="hidden" value="" name="cod_ordem_baixar" id="cod_ordem_baixar" />
                        <input type="submit" value="Gravar" class="btn btn-success btn-sm btn-block"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="location.reload()">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DO MODAL DE LIGAR -->
</section>