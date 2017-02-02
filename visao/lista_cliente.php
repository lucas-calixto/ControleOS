<section class="container">
    <article class="col-lg-8">
        <form class="form-horizontal">
            <fieldset>
                <form class="form-horizontal">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Cadastro de Clientes</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cod">Código Personalizado</label>  
                            <div class="col-md-8">
                                <input id="cod" name="cod" type="text" placeholder="Código personalizado" class="form-control input-md" required="">
                                <span class="help-block">Código do Internews</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="endereco_cliente">Endereço</label>  
                            <div class="col-md-8">
                                <input id="endereco_cliente" name="endereco_cliente" type="text" placeholder="Endereço" class="form-control input-md" required="">
                                <span class="help-block">Rua, numero</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome_cliente">Nome do Cliente</label>  
                            <div class="col-md-8">
                                <input id="nome_cliente" name="nome_cliente" type="text" placeholder="Nome" class="form-control input-md" required="">
                                <span class="help-block">Nome completo do cliente</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="bairro_cliente">Bairro</label>  
                            <div class="col-md-8">
                                <input id="bairro_cliente" name="bairro_cliente" type="text" placeholder="Bairro" class="form-control input-md" required="">
                                <span class="help-block">Bairro</span>  
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cidade_cliente">Cidade</label>
                            <div class="col-md-8">
                                <select id="cidade_cliente" name="cidade_cliente" class="form-control">
                                    <option value="1">Porteirinha</option>
                                    <option value="2">Rio Pardo de Minas</option>
                                    <option value="3">Serranópolis de Minas</option>
                                    <option value="4">Pai Pedro</option>
                                    <option value="5">Riacho dos Machados</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="telefone_um_cliente">Telefone Celular</label>  
                            <div class="col-md-8">
                                <input id="telefone_um_cliente" name="telefone_um_cliente" type="text" placeholder="Telefone" class="form-control input-md" required="">
                                <span class="help-block">(38) 9 9999-9999</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="telefone_dois_cliente">Telefone Fixo</label>  
                            <div class="col-md-8">
                                <input id="telefone_dois_cliente" name="telefone_dois_cliente" type="text" placeholder="Telefone" class="form-control input-md" required="">
                                <span class="help-block">(38) 3831-1111</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ip_cliente">IP do Cliente</label>  
                            <div class="col-md-8">
                                <input id="ip_cliente" name="ip_cliente" type="text" placeholder="IP" class="form-control input-md">
                                <span class="help-block">192.168.0.1</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pop_cliente">POP</label>  
                            <div class="col-md-8">
                                <input id="pop_cliente" name="pop_cliente" type="text" placeholder="POP" class="form-control input-md">
                                <span class="help-block">Vila Serranópolis</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_cliente">Usuário PPPoE</label>  
                            <div class="col-md-8">
                                <input id="user_cliente" name="user_cliente" type="text" placeholder="Usuário" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pass_cliente">Senha PPPoP</label>  
                            <div class="col-md-8">
                                <input id="pass_cliente" name="pass_cliente" type="text" placeholder="Senha" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="plano_cliente">Plano de Internet</label>
                            <div class="col-md-8">
                                <select id="plano_cliente" name="plano_cliente" class="form-control">
                                    <option value="1">1 Mbps</option>
                                    <option value="2">2 Mbps</option>
                                    <option value="3">3 Mbps</option>
                                    <option value="4">5 Mbps</option>
                                </select>
                            </div>
                        </div>

                        <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="enviar">Gravar</label>
                            <div class="col-md-8">
                                <button id="enviar" name="enviar" class="btn btn-success">Gravar</button>
                                <button id="Limpar" name="Limpar" class="btn btn-default">Limpar</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </fieldset>
        </form>

    </article>
</section>