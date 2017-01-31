<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

require_once './controle/TipoControle.php';
require_once './modelo/Tipo.php';

$controle = new TipoControle();
$tipo = new Tipo();

?>

<section class="container">
            <article class="col-lg-9">
                <div class="well">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Cadastro de Tipos</legend>
                            <div class="form-group">
                                <label for="desc_tipo" class="col-lg-2 control-label">Descrição:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="desc_tipo" placeholder="Descrição do tipo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
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
                        <?php foreach ($controle->lista() as $tipo) { ?>
                        <tr>
                            <td><span class="esp-tabela"><?= $tipo->getCod_tipo() ?></span></td>
                            <td><span class="esp-tabela"><?= $tipo->getDesc_tipo() ?></span></td>
                            <td><a href="#" title="Editar"><span class="glyphicon glyphicon-edit orange" aria-hidden="true"></span></a>
                                <a href="#" title="Exclir"><span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></a></td>
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