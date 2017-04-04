<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './controle/OrdemControle.php';
require_once './modelo/Ordem.php';
require_once './modelo/Cliente.php';
require_once './modelo/Tipo.php';
require_once './dao/ClienteDAO.php';
require_once './controle/TecnicoControle.php';
require_once './controle/TipoControle.php';

$controle = new OrdemControle();
$daoTecnico = new TecnicoControle();
$daoTipo = new TipoControle();
$ordem = new Ordem();
$tipo = new Tipo();
$daoCliente = new ClienteDAO();
$cliente = $daoCliente->busca(filter_input(INPUT_POST, "cod_cliente"));

if (!strcmp(filter_input(INPUT_GET, "metodo"), "gravar")) {
    $ordem->setCod_atendente_ordem($_SESSION['id_user']);
    $ordem->setCod_cliente_ordem(filter_input(INPUT_POST, "cod_cliente"));
    $ordem->setCod_tipo_ordem(filter_input(INPUT_POST, "cod_tipo"));
    $ordem->setDesc_ordem(filter_input(INPUT_POST, "desc_ordem"));
    $ordem->setCod_tecnico_ordem(null);
    $ordem->setDesc_total_ordem(filter_input(INPUT_POST, "desc_total"));
    $ordem->setSolicitatante_ordem(filter_input(INPUT_POST, "solicita_ordem"));
    $ordem->setStatus_ordem("ABERTA");

    if ($controle->cadastra($ordem)) {
        $resultado = "O.S. cadastrada com sucesso!";
        $extra = 'controle.php?pg=controleos';
        header("Location: http://$host$uri/$extra");
    } else {
        $resultado = "Erro ao cadastrar O.S.!";
    }
}
?>
<section class="container">
    <article class="col-lg-12">
        <form class="form-horizontal" action="controle.php?pg=novaos&metodo=gravar" method="POST">
            <fieldset>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="nome_cliente">Cliente</label>  
                    <div class="col-md-9">
                        <input id="nome_cliente" name="nome_cliente" type="text" value="<?= $cliente->getNome_cliente() ?>" placeholder="Cliente" class="form-control input-md" disabled="">
                        <span class="help-block">Nome do Cliente</span>  
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="cod_tipo">Tipo de Serviço</label>
                    <div class="col-md-9">
                        <select id="tipo_ordem" name="cod_tipo" class="form-control" required="">
                            <?php foreach ($daoTipo->lista(0, 100) as $tipo) { ?>
                                <option value="<?= $tipo->getCod_tipo() ?>"><?= $tipo->getDesc_tipo() ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block">Tipo de serviço a ser realizado</span>  
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="desc_ordem">Descrição do Serviço</label>  
                    <div class="col-md-9">
                        <input id="desc_ordem" name="desc_ordem" type="text" placeholder="Descrição" class="form-control input-md">
                        <span class="help-block">Descrição resumida do problema</span>  
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="solicita_ordem">Solicitante</label>  
                    <div class="col-md-9">
                        <input id="solicita_ordem" name="solicita_ordem" type="text" placeholder="Descrição" class="form-control input-md" required="">
                        <span class="help-block">Descrição resumida do problema</span>  
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="desc_total">Descrição Detalhada</label>
                    <div class="col-md-9">                     
                        <textarea class="form-control" id="desc_total" name="desc_total" style="height: 140px;"></textarea>
                    </div>
                </div>

                <input type="hidden" name="cod_cliente" value="<?= $cliente->getCod_cliente() ?>" />
                <div class=" col-lg-9 col-lg-offset-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Gravar</button>
                        <button type="reset" class="btn btn-default">Limpar</button>
                    </div>
                </div>
            </fieldset>
        </form>

    </article>

</section>