<table class="table">
    <thead>
        <tr>
            <th class="col-lg-3">Cliente</th>
            <th class="col-lg-1 text-right">Data</th>
            <th class="col-lg-1">Baixa</th>
            <th class="col-lg-2 text-center">Tipo de O.S.</th>
            <th class="col-lg-5">Detalhes</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qtd = count($daoRelatorio->lista(0, 1000));
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

        if (!empty(filter_input(INPUT_POST, "busca_cliente"))) {
            $nome_cliente = filter_input(INPUT_POST, "busca_cliente");
        }

        if (!empty(filter_input(INPUT_POST, "cidade_cliente"))) {
            $cidade_cliente = filter_input(INPUT_POST, "cidade_cliente");
        }

        foreach ($daoRelatorio->lista($inicio, $fim, $nome_cliente, $cidade_cliente) as $ordem) {
            ?>
            <tr>
                <td><?php
                    $cliente = $ordem->getCod_cliente_ordem();
                    echo $cliente->getNome_cliente();
                    ?>
                </td>
                <td class="text-right"><?= date('d/m/Y', strtotime($ordem->getData_cad_ordem())) ?></td>
                <td class=""><?php
                    //$horaInicio = (date("G", strtotime($ordem->getHora_inicio_ordem())) * 60) + date("i", strtotime($ordem->getHora_inicio_ordem()));
                    //$horaFim = (date("G", strtotime($ordem->getHora_fim_ordem())) * 60) + date("i", strtotime($ordem->getHora_fim_ordem()));
                    //echo $horaFim - $horaInicio . " Min";
                    echo date('d/m/Y', strtotime($ordem->getData_fim_ordem()));
                    ?>
                </td>
                <td class="text-center"><?php
                    $tipo = $ordem->getCod_tipo_ordem();
                    echo $tipo->getDesc_tipo();
                    ?>
                </td>
                <td><?= $ordem->getDesc_resolve_ordem() ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>