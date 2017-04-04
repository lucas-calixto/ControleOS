<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');
require_once './dao/ClienteDAO.php';
require_once './modelo/Cliente.php';

$dao = new ClienteDAO();
$cliente = new Cliente();

if (!strcmp(filter_input(INPUT_GET, "acao"), "gravar")) {
    $cliente = new Cliente();
    $cliente->setCod_cliente(filter_input(INPUT_POST, "cod_cliente"));
    $cliente->setUser_pppoe_cliente(filter_input(INPUT_POST, "user"));
    $cliente->setPass_pppoe_cliente(filter_input(INPUT_POST, "pass"));
    
    if ($dao->updateCliente($cliente)) {
        $resultado = "Atendente cadastrado com sucesso!";
        $extra = 'controle.php?pg=cliente';
        header("Location: http://$host$uri/$extra");
    } else {
    }
}
?>
<section class="container">
    <article class="col-lg-9">
        <div class="well">
            <form class="form-horizontal" method="POST" action="?pg=cliente&acao=gravar">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Editar Cliente</legend>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cod_cliente">Selecione o Cliente</label>
                        <div class="col-md-8">
                            <select id="cod_cliente" name="cod_cliente" class="form-control">
                                <?php foreach ($dao->lista() as $ln) { ?>
                                <option value="<?= $ln->getCod_cliente() ?>"><?= $ln->getCod_pers_cliente() ?> - <?= $ln->getNome_cliente() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user">Usuário PPPoE</label>  
                        <div class="col-md-8">
                            <input id="user" name="user" type="text" placeholder="Usuário" class="form-control input-md" required="">
                            <span class="help-block">Usuário do PPPoE</span>  
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pass">Senha PPPoE</label>  
                        <div class="col-md-8">
                            <input id="pass" name="pass" type="text" placeholder="Senha" class="form-control input-md" required="">
                            <span class="help-block">Senha PPPoE</span>  
                        </div>
                    </div>
                    <div class="col-lg-offset-4">
                        <input type="submit" value="Gravar" class="btn btn-default" />
                    </div>
                </fieldset>
            </form>
        </div>
    </article>
</section>